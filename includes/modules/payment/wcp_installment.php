<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Wirecard Central Eastern Europe GmbH
 * (abbreviated to Wirecard CEE) and are explicitly not part of the Wirecard CEE range of
 * products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 2 (GPLv2) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Wirecard CEE does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Wirecard CEE does not guarantee their full
 * functionality neither does Wirecard CEE assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Wirecard CEE does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */

require_once(DIR_FS_EXTERNAL . 'wirecardcheckoutpage/Payment.php');

class wcp_installment extends WirecardCheckoutPagePayment
{
    protected $_defaultSortOrder = 210;
    protected $_paymenttype = WirecardCEE_Stdlib_PaymentTypeAbstract::INSTALLMENT;
    protected $_logoFilename = 'installment.png';

    /**
     * display additional input fields on payment page
     *
     * @return array|bool
     */
    function selection()
    {
        $content = parent::selection();
        if ($content === false) {
            return false;
        }

        if (!xtc_session_is_registered('customer_id')) {
            return false;
        }

        $hasConsent = false;
        if ($this->getConfigParam('PROVIDER') == 'payolution' && $this->getConfigParam('PAYOLUTION_TERMS') == 'True') {
            $hasConsent = true;
            $fieldId = uniqid();
            $content['fields'][] = array(
                'title' => sprintf('<input id="%s" type="checkbox" name="consent" autocomplete="off" class="wcp_installment consent"/>',
                    $fieldId),
                'field' => sprintf('<label for="%s">%s</label>', $fieldId,
                    $this->_page->getText('payolution_consent', $this->getPayolutionLink()))
            );
        }

        $customer_id = $_SESSION['customer_id'];

        $dob = $this->getCustomerDob($customer_id);

        $field = sprintf('<input type="text" class="wcp_installment birthday mandatory" maxlength="10" data-wcp-fieldname="birthday" name="wcp_installment_birthday" value="%s">',
            $dob === null ? '' : $dob->format('m.d.Y'));

        $jsMinage = json_encode($this->getMinAge());
        $jsCode = json_encode($this->code);
        $jsMessage = json_encode($this->_page->getText('MIN_AGE_MESSAGE', $jsMinage));
        $jsHasConsent = json_encode($hasConsent);
        $jsConsentMessage = json_encode($this->_page->getText('CONSENT_MSG'));

        $field .= <<<HTML
        <script type="text/javascript">
        $(function () {
             
            $.fn.wcpValidateInstallment = function (messageBox) {
                
                var paymentCode = $jsCode;
                var dateStr = this.find('.' + paymentCode + '.birthday').val();
                var minAge = $jsMinage;
                var msg = '';
    
                dateStr = dateStr.replace(/[.-]/g, '/');
                    
                if (!wcpValidateMinAge(dateStr, minAge)) {
                    msg = $jsMessage;
                    messageBox.append('<p>' + msg + '</p>');
                }
    
                if ($jsHasConsent)
                {
                    if (!this.find('.' + paymentCode + '.consent').attr('checked')) {
                        msg = $jsConsentMessage;
                        messageBox.append('<p>' + msg + '</p>');
                    }
                }
    
                if (msg.length) {
                    messageBox.css('display', 'block');
                    return false;
                }
    
                return true;
            };
        });
        </script>
HTML;

        $content['fields'][] = array(
            'title' => $this->_page->getText('birthday'),
            'field' => $field
        );

        return $content;
    }

    /**
     * save additional info to session
     */
    public function pre_confirmation_check()
    {
        if (isset($_POST['wcp_installment_birthday'])) {
            $_SESSION['wcp_birthday'] = $_POST['wcp_installment_birthday'];
        }
	    parent::pre_confirmation_check();
    }

    /**
     * @return bool
     */
    function _preCheck()
    {
        if (!parent::_preCheck()) {
            return false;
        }

        if (!$this->invoiceInstallmentPreCheck()) {
            return false;
        }

        return true;
    }

    /**
     * whether sending of basket is forced
     *
     * @return bool
     */
    public function forceSendingBasket()
    {
        return true;
    }

    /**
     * autodeposit is not allowed with this payment
     *
     * @return bool
     */
    public function isAutoDepositAllowed()
    {
        return false;
    }

    /**
     * configuration array
     *
     * @return array
     */
    protected function _configuration()
    {
        $config = parent::_configuration();

        $config['PROVIDER'] = array(
            'configuration_value' => 'payolution',
            'set_function' => "wcp_installment_cfg_pull_down_provider( "
        );

        $config['PAYOLUTION_TERMS'] = array(
            'configuration_value' => 'True',
            'set_function' => 'xtc_cfg_select_option(array(\'True\', \'False\'), '
        );

        $config['PAYOLUTION_MID'] = array(
            'configuration_value' => ''
        );

        $config['BILLINGSHIPPING_SAME'] = array(
            'configuration_value' => 'True',
            'set_function' => 'xtc_cfg_select_option(array(\'True\', \'False\'), '
        );

        $config['BILLING_COUNTRIES'] = array(
            'configuration_value' => 'AT,DE,CH',
        );

        $config['SHIPPING_COUNTRIES'] = array(
            'configuration_value' => 'AT,DE,CH'
        );

        $config['CURRENCIES'] = array(
            'configuration_value' => 'EUR'
        );

        $config['MIN_AGE'] = array(
            'configuration_value' => '18'
        );

        $config['AMOUNT_MIN'] = array(
            'configuration_value' => '150'
        );

        $config['AMOUNT_MAX'] = array(
            'configuration_value' => '3500'
        );

        return $config;
    }
}

/**
 * installment option list for module config
 *
 * @param string $provider
 * @param string $key
 *
 * @return string
 */
function wcp_installment_cfg_pull_down_provider($provider, $key = '')
{
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $providers = array(
        array('id' => 'payolution', 'text' => 'Payolution'),
        array('id' => 'ratepay', 'text' => 'RatePay')
    );

    return xtc_draw_pull_down_menu($name, $providers, $provider);
}


