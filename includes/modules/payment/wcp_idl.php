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

class wcp_idl extends WirecardCheckoutPagePayment
{
    protected $_defaultSortOrder = 80;
    protected $_paymenttype = WirecardCEE_Stdlib_PaymentTypeAbstract::IDL;
    protected $_logoFilename = 'ideal.png';
    protected $_sendFinancialInstitution = true;

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

        $field = '<select class="wcp_idl input-select mandatory" data-wcp-fieldname="fi" name="wcp_ideal_financialinstitution">';

        $field .= sprintf('<option value="">%s</option>', $this->_page->getText('CHOOSE_FINANCIALINSTITUTION'));

        foreach (WirecardCEE_QPay_PaymentType::getFinancialInstitutions($this->_paymenttype) as $value => $name) {
            $field .= sprintf('<option value="%s">%s</option>', htmlspecialchars($value), $name);
        }

        $field .= '</select>';
        $content['fields'][] = array(
            'title' => $this->_page->getText('financialinstitution'),
            'field' => $field
        );

        return $content;
    }

    /**
     * save additional info to session
     */
    public function pre_confirmation_check()
    {
        if (isset($_POST['wcp_ideal_financialinstitution'])) {
            $_SESSION['wcp_financialinstitution'] = $_POST['wcp_ideal_financialinstitution'];
        }
    }
}
