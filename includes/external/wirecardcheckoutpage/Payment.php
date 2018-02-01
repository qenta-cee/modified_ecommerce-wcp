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

require_once(DIR_FS_EXTERNAL . 'wirecardcheckoutpage/Page.php');


class WirecardCheckoutPagePayment
{
    public $code;
    public $title;
    public $title_checkout;
    public $title_frontend;
    public $description;
    public $enabled;
    public $form_action_url = '';

    protected $_defaultSortOrder = 0;
    protected $_check;
    protected $_forceSendAdditionalData = false;
    protected $_sendFinancialInstitution = false;
    protected $_logo;
    protected $_logoWidth = '50px';

    /**
     * order is created before redirect to psp starts
     *
     * @var bool
     */
    public $tmpOrders = true;

    /**
     * displayed during checkout
     *
     * @var string
     */
    protected $info;

    /**
     * wirecard paymenttype
     *
     * @var string
     */
    protected $_paymenttype = null;

    /**
     * filename for paymenttype logo
     *
     * @var string
     */
    protected $_logoFilename = null;


    /**
     * whether js has been already added
     *
     * @var bool
     */
    static protected $hasJavascript = false;

    protected $_page;

    public function __construct()
    {
        $this->_page = new WirecardCheckoutPage();
        $this->code = get_class($this);

        $c = strtoupper($this->code);

        $this->title = $this->constant("MODULE_PAYMENT_{$c}_TITLE");
        $this->title_checkout = $this->constant("MODULE_PAYMENT_{$c}_TEXT_TITLE");

        $this->_logo = ($this->_logoFilename) ? '<img src="' . DIR_WS_EXTERNAL . 'wirecardcheckoutpage/images/paymenttypes/' . $this->_logoFilename
            . '" alt="'
            . htmlspecialchars($this->constant("MODULE_PAYMENT_{$c}_TEXT_TITLE"))
            . ' Logo" style="max-width:' . $this->_logoWidth . '"/>&nbsp;&nbsp;' : '';

        $this->title = $this->_logo . $this->title;
        $this->title_frontend = $this->_logo . $this->title_checkout;
        $this->info = $this->constant("MODULE_PAYMENT_{$c}_TEXT_INFO"); // displayed in checkout
        $this->description = ""; // displayed in admin area

        $this->extended_description = $this->_page->getText('CONFIGURATION_HELP');

        $this->extended_description .= '<br/><a class="button" href="' . xtc_href_link('wirecardcheckoutpage_config.php') . '">'
            . $this->_page->getText('configure') . '</a>';
        $this->sort_order = $this->constant("MODULE_PAYMENT_{$c}_SORT_ORDER");

        $this->enabled = self::constant("MODULE_PAYMENT_{$c}_STATUS") == 'True';
        define("MODULE_PAYMENT_{$c}_STATUS_TITLE", $this->_page->getText('active'));
        define("MODULE_PAYMENT_{$c}_STATUS_DESC", '');
        define("MODULE_PAYMENT_{$c}_SORT_ORDER_TITLE", $this->_page->getText('sort_order'));
        define("MODULE_PAYMENT_{$c}_SORT_ORDER_DESC", '');
        define("MODULE_PAYMENT_{$c}_ALLOWED_TITLE", $this->_page->getText('allowed'));
        define("MODULE_PAYMENT_{$c}_ALLOWED_DESC", $this->_page->getText('allowed_desc'));
        define("MODULE_PAYMENT_{$c}_ZONE_TITLE", $this->_page->getText('zone'));
        define("MODULE_PAYMENT_{$c}_ZONE_DESC", $this->_page->getText('zone_desc'));
    }

    /**
     * @see includes/classes/payment.php update_status
     */
    public function update_status()
    {
        global $order;
        $c = strtoupper($this->code);
        $zone = (int)constant("MODULE_PAYMENT_{$c}_ZONE");

        if ($this->enabled == true && $zone > 0) {
            $check_flag = false;
            $check_query = xtc_db_query("SELECT zone_id FROM " . TABLE_ZONES_TO_GEO_ZONES . " WHERE geo_zone_id = '"
                . $zone . "' AND zone_country_id = '" . $order->billing['country']['id']
                . "' ORDER BY zone_id");

            while ($check = xtc_db_fetch_array($check_query)) {
                if ($check['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } elseif ($check['zone_id'] == $order->billing['zone_id']) {
                    $check_flag = true;
                    break;
                }
            }

            if ($check_flag == false) {
                $this->enabled = false;
            }
        }
    }


    /**
     * Return Text displayed besides the order button
     *
     * @return string
     */
    public function process_button()
    {
        return false;
    }

    /**
     * before payment process hook
     */
    public function before_process()
    {
    }


    /**
     * payment action, redirect to psp
     */
    public function payment_action()
    {
        $_SESSION['wcp_success_info'] = null;
        $_SESSION['wcp_error_message'] = null;
        xtc_redirect(xtc_href_link('checkout_payment_iframe.php', '', 'SSL'));
    }

    /**
     * init payment request and return redirect url
     * if returning empty string redirect to FILENAME_CHECKOUT_PAYMENT is done
     *
     * @return string
     */
    public function iframeAction()
    {
        $orders_id = $_SESSION['tmp_oID'];

        /** @var Order $order */
        $order = new order($orders_id);

        try {
            $initResponse = $this->_page->initPayment($order, $this);

            if ($initResponse->getStatus() == WirecardCEE_QPay_Response_Initiation::STATE_FAILURE) {
                $consumerMessages = array();
                $consumerMessages[] = html_entity_decode($initResponse->getError());

                $this->_page->log(__METHOD__ . ':' . implode(', ', $consumerMessages));
                $_SESSION['wcp_error_message'] = $consumerMessages;
                xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'SSL', true,
                    false));
            }

            return $initResponse->getRedirectUrl();
        } catch (Exception $e) {
            $this->_page->log(__METHOD__ . ':' . $e->getMessage());
            $_SESSION['wcp_error_message'] = $this->_page->getText('frontend_initerror');
            xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'SSL', true, false));
        }

        return '';
    }

    /**
     * error message displayed on FILENAME_CHECKOUT_PAYMENT
     *
     * @return array|string
     */
    public function get_error()
    {
        if (!isset($_SESSION['wcp_error_message']) || !count($_SESSION['wcp_error_message'])) {
            return '';
        }

        $msgs = $_SESSION['wcp_error_message'];
        if (is_array($msgs)) {
            $msgs = implode("\n", $msgs); // dont implode with <br/>, will be escaped
        }

        return array(
            'title' => $this->title,
            'error' => $msgs
        );
    }

    /**
     * after checkout process hook
     */
    public function after_process()
    {
    }

    /**
     * display paymenttype on payment page
     *
     * @return array|bool
     */
    public function selection()
    {
        if (!$this->_preCheck()) {
            return false;
        }

        $paymentType = $this->_paymenttype;

        $fields = array();

        $fields[] = array(
            'title' => '',
            'field' => sprintf('<input type="hidden" id="%s_paymenttype" name="wcp-paymenttype" value="%s"/>', $this->code,
                htmlspecialchars($paymentType))
        );

        if (!self::$hasJavascript) {
            $fields[] = array(
                'title' => '',
                'field' => sprintf('<script type="text/javascript" src="%s"></script>',
                    xtc_href_link(DIR_WS_EXTERNAL . 'wirecardcheckoutpage/js/script.js', '', 'SSL', false))
            );
            self::$hasJavascript = true;
        }
        $info = $this->_logo;
        $info .= sprintf('<div class="errormessage" style="display: none;" id="%s_messagebox"></div>', $this->code);
        $c = strtoupper($this->code);

        unset($_SESSION['wcp_financialinstitution']);
        unset($_SESSION['wcp_birthday']);

        return array(
            'id' => $this->code,
            'module' => $this->constant("MODULE_PAYMENT_{$c}_TEXT_TITLE"),
            'description' => $info,
            'fields' => $fields
        );
    }

    /**
     * add custom js validation
     *
     * @return bool
     */
    public function javascript_validation()
    {
        return false;
    }


    /**
     * @return bool
     */
    public function pre_confirmation_check()
    {
        return false;
    }

    /**
     * return additional info to be displayed on the checkout confirmation page
     *
     * @return bool|array
     */
    public function confirmation()
    {
        if ($this->getConfigParam('PROVIDER') !== 'ratepay')
            return;

	    $config = $this->_page->_getConfigArray();
	    $customer_id = $config['CUSTOMER_ID'];

	    if ( isset( $_SESSION['wcp-consumerDeviceId'] ) ) {
		    $consumerDeviceId = $_SESSION['wcp-consumerDeviceId'];
	    } else {
		    $timestamp = microtime();
		    $consumerDeviceId = md5( $customer_id . "_" . $timestamp );
		    $_SESSION['wcp-consumerDeviceId'] = $consumerDeviceId;
	    }
	    $ratepay = '<script language="JavaScript">var di = {t:"' . $consumerDeviceId . '",v:"WDWL",l:"Checkout"};</script>';
	    $ratepay .= '<script type="text/javascript" src="//d.ratepay.com/' . $consumerDeviceId . '/di.js"></script>';
	    $ratepay .= '<noscript><link rel="stylesheet" type="text/css" href="//d.ratepay.com/di.css?t=' . $consumerDeviceId . '&v=WDWL&l=Checkout"></noscript>';
	    $ratepay .= '<object type="application/x-shockwave-flash" data="//d.ratepay.com/WDWL/c.swf" width="0" height="0"><param name="movie" value="//d.ratepay.com/WDWL/c.swf" /><param name="flashvars" value="t=' . $consumerDeviceId . '&v=WDWL"/><param name="AllowScriptAccess" value="always"/></object>';

	    $fields = array();

	    $fields[] = array(
		    'title' => '',
		    'field' => $ratepay
	    );
        $ret = array(
            'title' => $this->title,
            'fields' => $fields
        );

        return $ret;
    }

    /**
     * check whether paymenttype is available or not
     *
     * @return bool
     */
    public function _preCheck()
    {
        return true;
    }

    /**
     * check if module ist enabled
     *
     * @return bool
     */
    public function check()
    {
        if (!isset ($this->_check)) {
            $c = strtoupper($this->code);
            $check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION
                . " WHERE configuration_key='MODULE_PAYMENT_{$c}_STATUS'");
            $this->_check = xtc_db_num_rows($check_query);
        }

        return $this->_check;
    }

    /**
     * invoked by payment system, message to be displayed on the checkout success page
     *
     * @return array|bool
     */
    function success()
    {
        if (!isset($_SESSION['wcp_success_info'])) {
            return false;
        }

        $confirmation = array(
            array(
                'title' => $this->title_frontend . ': ',
                'class' => $this->code,
                'fields' => $_SESSION['wcp_success_info']
            )
        );

        return $confirmation;
    }

    /**
     * plugin installation routine
     */
    public function install()
    {
        $admin_files = array(
            'wirecardcheckoutpage_config.php',
            'wirecardcheckoutpage_support.php',
            'wirecardcheckoutpage_tx.php'
        );

        foreach ($admin_files as $admin_file) {
            $admin_include_file = DIR_FS_DOCUMENT_ROOT . DIRECTORY_SEPARATOR . "_ADMIN_INCLUDES_" . DIRECTORY_SEPARATOR . $admin_file;
            if (file_exists($admin_include_file)) {
                rename($admin_include_file, DIR_FS_ADMIN . $admin_file);
            }
        }

        $config = $this->_configuration();
        $sort_order = 0;
        foreach ($config as $key => $data) {
            $install_query = "INSERT INTO " . TABLE_CONFIGURATION
                . " ( configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, use_function, date_added) "
                . "VALUES ('MODULE_PAYMENT_" . strtoupper($this->code) . "_" . $key . "', '"
                . $data['configuration_value'] . "', '6', '" . $sort_order . "', '"
                . addslashes($data['set_function']) . "', '" . addslashes($data['use_function'])
                . "', NOW())";
            xtc_db_query($install_query);
            $sort_order++;
        }

        // create table for saving transaction data and logging
        $q = "CREATE TABLE IF NOT EXISTS " . TABLE_PAYMENT_WCP . " (
            `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `orders_id` INT(10) NULL,
            `ordernumber` VARCHAR(32) NULL,
            `paymentname` VARCHAR(32) NULL,
            `paymentmethod` VARCHAR(32) NOT NULL,
            `paymentstate` VARCHAR(32) NOT NULL,
            `gatewayreference` VARCHAR(32) NULL,
            `amount` FLOAT NOT NULL,
            `currency` VARCHAR(3) NOT NULL,
            `message` VARCHAR(255) NULL,
            `request` TEXT NULL,
            `response` TEXT NULL,
            `status` ENUM ('ok', 'error') NOT NULL DEFAULT 'ok',
            `created` DATETIME NOT NULL,
            `modified` DATETIME NULL,
            PRIMARY KEY (id))";


        xtc_db_query($q);

        $fields = array(
            'wirecardcheckoutpage_support',
            'wirecardcheckoutpage_config',
            'wirecardcheckoutpage_tx'
        );


        foreach ($fields as $f) {
            $check_query = xtc_db_query('SHOW COLUMNS FROM admin_access like "' . $f . '"');
            if (xtc_db_num_rows($check_query) == 0) {
                xtc_db_query('ALTER TABLE admin_access ADD ' . $f . ' INT(1) NOT NULL DEFAULT "0"');
                xtc_db_query('UPDATE admin_access SET  ' . $f . ' = "1" WHERE customers_id = "1" OR customers_id = "groups"');
            }
        }
    }


    /**
     * plugin removal routine
     */
    public function remove()
    {
        xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key IN ('" . implode("', '",
                $this->keys())
            . "')");
    }


    /**
     * return config keys
     *
     * @return array
     */
    public function keys()
    {
        $ckeys = array_keys($this->_configuration());
        $keys = array();
        foreach ($ckeys as $k) {
            $keys[] = 'MODULE_PAYMENT_' . strtoupper($this->code) . '_' . $k;
        }

        return $keys;
    }


    /**
     * Returns array of years for credit cards issue date
     *
     * @return array
     */
    public function getCreditCardIssueYears()
    {
        return range(date('Y') - 10, date('Y'));
    }


    /**
     * Returns array of years for credit cards expiry
     *
     * @return array
     */
    public function getCreditCardYears()
    {
        return range(date('Y'), date('Y') + 10);
    }

    /**
     * return min age, depends on the selected provider
     *
     * @return int
     */
    protected function getMinAge()
    {
        return $this->getConfigParam('provider') == 'payolution' ? 18 : (int)$this->getConfigParam('min_age');
    }

    /**
     * checks for invoice and installment, provider dependent
     *
     * @return bool
     */
    protected function invoiceInstallmentPreCheck()
    {
        $provider = $this->getConfigParam("PROVIDER");
        switch ($provider) {
            case 'payolution':
                return $this->payolutionPreCheck();

            case 'ratepay':
            case 'wirecard':
                return $this->ratePayPreCheck();

            default:
                return false;
        }
    }

    /**
     * return number of basket items
     *
     * @param $order
     *
     * @return int
     */
    protected function getNumBasketItems($order)
    {
        $ret = 0;
        foreach ($order->products as $p) {
            $ret += $p['qty'];
        }

        return $ret;
    }

    /**
     * checks for payolution
     *
     * @return bool
     */
    protected function payolutionPreCheck()
    {
        global $order, $xtPrice;

        $consumerID = xtc_session_is_registered('customer_id') ? $_SESSION['customer_id'] : "";

        $currency = $order->info['currency'];
        $total = $order->info['total'];
        $amount = round($xtPrice->xtcCalculateCurrEx($total, $currency), $xtPrice->get_decimal_places($currency));

        $numItems = $this->getNumBasketItems($order);
        $bd = $this->getCustomerDob($consumerID);
        if ($bd !== null) {
            $diff = $bd->diff(new DateTime);
            $customerAge = $diff->format('%y');
            if ($customerAge < $this->getMinAge()) {
                return false;
            }
        }

        if ($this->getConfigParam('BILLINGSHIPPING_SAME') == 'True') {
            if (!$this->compareAddress($order->billing, $order->delivery)) {
                return false;
            }
        }

        if (!in_array($currency, $this->getAllowedCurrencies())) {
            return false;
        }

        if (count($this->getAllowedShippingCountries())) {
            if (!in_array($order->delivery['country']['iso_code_2'], $this->getAllowedShippingCountries())) {
                return false;
            }
        }

        if (count($this->getAllowedBillingCountries())) {
            if (!in_array($order->billing['country']['iso_code_2'], $this->getAllowedBillingCountries())) {
                return false;
            }
        }

        if ($this->getAmountMin() && $this->getAmountMin() > $amount) {
            return false;
        }

        if ($this->getAmountMax() && $this->getAmountMax() < $amount) {
            return false;
        }

        return true;
    }


    /**
     * checks for RatePay
     *
     * @return bool
     */
    protected function ratePayPreCheck()
    {
        // currently the same
        return $this->payolutionPreCheck();
    }

    /**
     * return configured currencies
     *
     * @return array
     */
    protected function getAllowedCurrencies()
    {
        return array_map(function ($e) {
            return trim($e);
        }, explode(',', $this->getConfigParam('CURRENCIES')));
    }


    /**
     * return configured billing countries
     *
     * @return array
     */
    protected function getAllowedBillingCountries()
    {
        return array_map(function ($e) {
            return trim($e);
        }, explode(',', $this->getConfigParam('BILLING_COUNTRIES')));
    }

    /**
     * return configured shipping countries
     *
     * @return array
     */
    protected function getAllowedShippingCountries()
    {
        return array_map(function ($e) {
            return trim($e);
        }, explode(',', $this->getConfigParam('SHIPPING_COUNTRIES')));
    }

    /**
     * return min order amount
     *
     * @return int
     */
    protected function getAmountMin()
    {
        return (int)$this->getConfigParam('AMOUNT_MIN');
    }

    /**
     * return max order amount
     *
     * @return int
     */
    protected function getAmountMax()
    {
        return (int)$this->getConfigParam('AMOUNT_MAX');
    }

    /**
     * deep compare of addresses
     *
     * @param array $a
     * @param array $b
     *
     * @return bool
     */
    protected function compareAddress($a, $b)
    {
        $fields = array(
            'firstname',
            'lastname',
            'gender',
            'company',
            'street_address',
            'suburb',
            'postcode',
            'city',
            'state',
            'country_id'
        );

        foreach ($fields as $f) {
            if (!array_key_exists($f, $b) && array_key_exists($f, $a)) {
                return false;
            }

            if (!array_key_exists($f, $a) && array_key_exists($f, $b)) {
                return false;
            }

            if ($a[$f] != $b[$f]) {

                return false;
            }

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
        return false;
    }

    /**
     * whether automated deposit is allowed or not
     *
     * @return bool
     */
    public function isAutoDepositAllowed()
    {
        return true;
    }

    /**
     * whether financial institution must be sent
     *
     * @return bool
     */
    public function getSendFinancialInstitution()
    {
        return $this->_sendFinancialInstitution;
    }

    /**
     * whether additional consumer data should be send
     *
     * @return bool
     */
    public function getForceSendingAdditionalData()
    {
        return $this->_forceSendAdditionalData;
    }

    /**
     * return wirecard paymenttype name
     *
     * @return string
     */
    public function getPaymentType()
    {
        return $this->_paymenttype;
    }

    /**
     * return link to payolution consent page
     *
     * @return string
     */
    public function getPayolutionLink()
    {
        $mid = $this->getConfigParam('payolution_mid');
        if ($mid === null) {
            return '';
        }

        $mId = urlencode(base64_encode($mid));

        if (strlen($mId)) {
            return sprintf('<a href="https://payment.payolution.com/payolution-payment/infoport/dataprivacyconsent?mId=%s" target="_blank">%s</a>',
                $mId, $this->_page->getText('consent'));
        } else {
            return $this->_page->getText('consent');
        }
    }

    /**
     * @param $customer_id
     *
     * @return null|DateTime
     */
    protected function getCustomerDob($customer_id)
    {
        $customer = null;
        $customer_query = xtc_db_query('SELECT DATE_FORMAT(customers_dob, "%Y-%m-%d") AS customers_dob FROM ' . TABLE_CUSTOMERS . ' WHERE customers_id = "' . xtc_db_input($customer_id) . '"');
        if (xtc_db_num_rows($customer_query)) {
            $customer = xtc_db_fetch_array($customer_query);
        }

        if ($customer === null) {
            return null;
        }

        if ($customer['customers_dob'] == '0000-00-00') {
            return null;
        }

        return new DateTime($customer['customers_dob']);
    }

    /**
     * checkout for defined constant and return value
     *
     * @param $p_name
     *
     * @return mixed|null
     */
    protected function constant($p_name)
    {
        return (defined($p_name)) ? constant($p_name) : null;
    }

    /**
     * return payment specific configuration param
     *
     * @param string $param
     *
     * @return mixed|null
     */
    protected function getConfigParam($param)
    {
        $code = strtoupper($this->code);
        $param = strtoupper($param);

        return $this->constant("MODULE_PAYMENT_{$code}_{$param}");
    }

    /**
     * configuration array
     *
     * @return array
     */
    protected function _configuration()
    {
        $config = array(
            'STATUS' => array(
                'configuration_value' => 'True',
                'set_function' => 'xtc_cfg_select_option(array(\'True\', \'False\'), ',
            ),
            'ALLOWED' => array(
                'configuration_value' => '',
            ),
            'ZONE' => array(
                'configuration_value' => '0',
                'use_function' => 'xtc_get_zone_class_title',
                'set_function' => 'xtc_cfg_pull_down_zone_classes(',
            ),
            'SORT_ORDER' => array(
                'configuration_value' => $this->_defaultSortOrder,
            ),
        );

        return $config;
    }

    /**
     * print payment info on orders detail page
     *
     * @param $orders_id
     */
    public function admin_orderinfo($orders_id)
    {
        $wcpTransaction = new WirecardCheckoutPageTransaction();

        $fields = array(
            'ordernumber',
            'paymentmethod',
            'paymentstate',
            'gatewayreference',
            'amount',
            'currency',
            'message',
            'status'
        );
        $txData = $wcpTransaction->getByOrderId($orders_id);

        if ($txData !== null) {
            echo '<tr>';
            printf('<td class="main">&nbsp;</td><td><a href="%s">%s</a></td>',
                xtc_href_link_admin('admin/wirecardcheckoutpage_tx.php', 'action=edit&txId=' . $txData['id']),
                $this->_page->getText('BACKEND_HEADING_TITLE'));

            echo '</tr>';
            foreach ($fields as $f) {
                echo '<tr>';
                $v = htmlspecialchars($txData[$f]);
                printf('<td class="main">%s</td><td>%s</td>', $this->_page->getText('TABLE_HEADING_' . $f), $v);
                echo '</tr>';
            }


            if (strlen($txData['response'])) {
                $exclude = array('paymenttype', 'modifiedwcptxid');
                $respData = json_decode($txData['response']);
                if (is_object($respData)) {
                    foreach ($respData as $f => $v) {
                        foreach ($fields as $_f) {
                            if ($_f == strtolower($f)) {
                                continue 2;
                            }
                        }
                        if (in_array(strtolower($f), $exclude)) {
                            continue;
                        }

                        echo '<tr>';
                        $v = htmlspecialchars($v);
                        printf('<td class="main">%s</td><td>%s</td>', $f, $v);
                        echo '</tr>';

                    }
                }
            }
        }
    }
}


/**
 * exception which must not be presented to the enduser
 *
 * Class WirecardCheckoutPageException
 */
class WirecardCheckoutPageException extends Exception
{
}

/**
 * exception which may be presented to the enduser
 *
 * Class WirecardCheckoutPageUserException
 */
class WirecardCheckoutPageUserException extends WirecardCheckoutPageException
{
}