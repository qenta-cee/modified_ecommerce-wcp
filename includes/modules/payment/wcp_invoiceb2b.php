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

require_once(DIR_FS_CATALOG . 'includes/modules/payment/wcp_invoice.php');


class wcp_invoiceb2b extends wcp_invoice
{
    protected $_defaultSortOrder = 61;
    protected $_logoFilename = 'invoiceb2b.png';
    protected $_b2b = true;
	protected $_forceSendAdditionalData = true;

    public function pre_confirmation_check()
    {
        return false;
    }

    /**
     * @return bool
     */
    function _preCheck()
    {
        global $order, $xtPrice;

        if (!parent::_preCheck()) {
            return false;
        }

        if (ACCOUNT_COMPANY != 'true') {
            $this->_page->log(__METHOD__ . ':Customer company fields not enabled.');
            return false;
        }

        if (!isset($order->customer['company']) || !strlen($order->customer['company'])) {
            return false;
        }

        $currency = $order->info['currency'];
        $total = $order->info['total'];
        $amount = round($xtPrice->xtcCalculateCurrEx($total, $currency), $xtPrice->get_decimal_places($currency));

        $numItems = count($order->products);

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
     * whether sending of basket is forced
     *
     * @return bool
     */
    public function forceSendingBasket()
    {
        return true;
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
            'set_function' => "wcp_invoice_cfg_pull_down_provider( "
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

        $config['AMOUNT_MIN'] = array(
            'configuration_value' => '25'
        );

        $config['AMOUNT_MAX'] = array(
            'configuration_value' => '3500'
        );

        return $config;
    }
}
