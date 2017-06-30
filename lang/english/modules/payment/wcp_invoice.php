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

define('MODULE_PAYMENT_WCP_INVOICE_TEXT_TITLE', 'Invoice');
define('MODULE_PAYMENT_WCP_INVOICE_TITLE', 'Wirecard Checkout Page Invoice');
define('MODULE_PAYMENT_WCP_INVOICE_PROVIDER_TITLE', 'Provider');

define('MODULE_PAYMENT_WCP_INVOICE_AMOUNT_MIN_TITLE', 'Order minimum amount');
define('MODULE_PAYMENT_WCP_INVOICE_AMOUNT_MAX_TITLE', 'Order maximum amount');

define('MODULE_PAYMENT_WCP_INVOICE_BILLING_COUNTRIES_TITLE', 'Allowed billing countries');
define('MODULE_PAYMENT_WCP_INVOICE_BILLING_COUNTRIES_DESC', 'Comma separated, e.g. AT,DE');

define('MODULE_PAYMENT_WCP_INVOICE_SHIPPING_COUNTRIES_TITLE', 'Allowed shipping countries');
define('MODULE_PAYMENT_WCP_INVOICE_SHIPPING_COUNTRIES_DESC', 'Comma separated, e.g. AT,DE');

define('MODULE_PAYMENT_WCP_INVOICE_BILLINGSHIPPING_SAME_TITLE', 'Billing/shipping address must be identical');
define('MODULE_PAYMENT_WCP_INVOICE_PAYOLUTION_MID_TITLE', 'payolution mID');
define('MODULE_PAYMENT_WCP_INVOICE_PAYOLUTION_MID_DESC', 'Your payolution merchant ID, non-base64-encoded.');

define('MODULE_PAYMENT_WCP_INVOICE_PAYOLUTION_TERMS_TITLE', 'payolution terms');
define('MODULE_PAYMENT_WCP_INVOICE_PAYOLUTION_TERMS_DESC',
    'Consumer must accept payolution terms during the checkout process. <br/> <a href="https://guides.wirecard.at/payment_methods:invoice:payolution" target="_blank">More Informations</a>');

define('MODULE_PAYMENT_WCP_INVOICE_CURRENCIES_TITLE', 'Accepted currencies');
define('MODULE_PAYMENT_WCP_INVOICE_CURRENCIES_DESC', 'Comma separated, e.g. EUR,USD,CHF');

define('MODULE_PAYMENT_WCP_INVOICE_MIN_AGE_TITLE', 'Consumer minimum age');
define('MODULE_PAYMENT_WCP_INVOICE_MIN_AGE_DESC', 'Only applicable for RatePay.');