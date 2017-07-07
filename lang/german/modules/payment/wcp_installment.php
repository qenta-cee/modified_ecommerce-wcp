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

define('MODULE_PAYMENT_WCP_INSTALLMENT_TEXT_TITLE', 'Kauf auf Raten');
define('MODULE_PAYMENT_WCP_INSTALLMENT_TITLE', 'Wirecard Checkout Page Kauf auf Raten');
define('MODULE_PAYMENT_WCP_INSTALLMENT_PROVIDER_TITLE', 'Provider');

define('MODULE_PAYMENT_WCP_INSTALLMENT_AMOUNT_MIN_TITLE', 'Bestellung Minimalbetrag');
define('MODULE_PAYMENT_WCP_INSTALLMENT_AMOUNT_MAX_TITLE', 'Bestellung Maximalbetrag');
define('MODULE_PAYMENT_WCP_INSTALLMENT_BILLING_COUNTRIES_TITLE', 'Erlaubte L&auml;nder Rechnung');
define('MODULE_PAYMENT_WCP_INSTALLMENT_BILLING_COUNTRIES_DESC', 'Kommasepariert, z.B. AT,DE');

define('MODULE_PAYMENT_WCP_INSTALLMENT_SHIPPING_COUNTRIES_TITLE', 'Erlaubte L&auml;nder Versand');
define('MODULE_PAYMENT_WCP_INSTALLMENT_SHIPPING_COUNTRIES_DESC', 'Kommasepariert, z.B. AT,DE');

define('MODULE_PAYMENT_WCP_INSTALLMENT_BILLINGSHIPPING_SAME_TITLE', 'Rechnungs/Versandadresse m&uuml;ssen ident sein');
define('MODULE_PAYMENT_WCP_INSTALLMENT_PAYOLUTION_MID_TITLE', 'payolution mID');
define('MODULE_PAYMENT_WCP_INSTALLMENT_PAYOLUTION_MID_DESC', 'Ihre payolution H&auml;ndler ID, nicht-base64-encoded.');

define('MODULE_PAYMENT_WCP_INSTALLMENT_PAYOLUTION_TERMS_TITLE', 'payolution AGB');
define('MODULE_PAYMENT_WCP_INSTALLMENT_PAYOLUTION_TERMS_DESC',
    'Der Kunde muss die payolution Zustimmungserkl&auml;rung w&auml;hrend des Checkout akzeptieren. <br/> <a href="https://guides.wirecard.at/payment_methods:invoice:payolution" target="_blank">Mehr Information</a>');

define('MODULE_PAYMENT_WCP_INSTALLMENT_CURRENCIES_TITLE', 'Akzeptierte W&auml;hrungen');
define('MODULE_PAYMENT_WCP_INSTALLMENT_CURRENCIES_DESC', 'Kommasepariert, z.B. EUR,USD,CHF');

define('MODULE_PAYMENT_WCP_INSTALLMENT_MIN_AGE_TITLE', 'Minimalalter des Konsumenten');
define('MODULE_PAYMENT_WCP_INSTALLMENT_MIN_AGE_DESC', 'Nur f&uuml;r RatePay relevant.');
