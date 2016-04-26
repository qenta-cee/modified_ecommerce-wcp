<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Wirecard Central Eastern Europe GmbH
 * (abbreviated to Wirecard CEE) and explicitly do not form part of the Wirecard CEE range
 * of products and services.
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 2 (GPLv2) and can be used, developed and passed to third parties under
 * the same terms.
 * However, Wirecard CEE does not provide any guarantee or accept any liability for any
 * errors occurring when used in an enhanced, customized shop system configuration.
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 * The customer uses the plugin at own risk. Wirecard CEE does not guarantee its full
 * functionality neither does Wirecard CEE assume liability for any disadvantage related
 * to the use of this plugin. Additionally Wirecard CEE does not guarantee its full
 * functionality for customized shop systems or installed plugins of other vendors of
 * plugins within the same shop system.
 * The customer is responsible for testing the plugin's functionality within its own shop
 * system before using it within a production environment of a shop system.
 * By installing the plugin to the shop system the customer agrees to the terms of use.
 * Please do not use these plugins if you do not agree to this terms of use!
 */

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TEXT_TITLE', 'Wirecard Checkout Page');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TEXT_DESCRIPTION', 'Wirecard Checkout Page<br>Additional information about Wirecard products can be obtained from http://www.wirecard.at');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_STATUS_TITLE','Enable Wirecard Checkout Page Module');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_STATUS_DESC','Do you want to accept Wirecard Checkout Page payments?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CUSTOMERID_TITLE','Customer ID');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CUSTOMERID_DESC','Enter the customer id you received from WirecardCEE.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SHOPID_TITLE','Shop ID');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SHOPID_DESC','Enter the shop id you received from WirecardCEE.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SECRET_TITLE','Secret');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SECRET_DESC','Enter the secret string (preshared key) you received from WirecardCEE for the fingerprint-hash.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_USE_IFRAME_TITLE','use IFrame');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_USE_IFRAME_DESC','Start Wirecard Checkout Page in an IFrame inside your Shop.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SELECT_TITLE','Enable payment type SELECT');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SELECT_DESC','The customer can select the payment type whithin Wirecard Checkout Page. If activated, no other payment type is displayed within the shop.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_TEXT_TITLE','Paysys text');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_TEXT_DESC','Enter the text which should be displayed as description for the payment type SELECT (e.g. MasterCard, Visa, ...).');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARD_TITLE','Credit Card');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARD_DESC','Enable payment type Credit Card?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MAESTRO_TITLE','Maestro SecureCode');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MAESTRO_DESC','Enable payment type Maestro SecureCode?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EPS_TITLE','eps Online Bank Transfer');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EPS_DESC','Enable payment type eps Online Bank Transfer?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PBX_TITLE','Mobile Phone Invoicing');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PBX_DESC','Enable payment type Mobile Phone Invoicing?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PSC_TITLE','paysafecard');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PSC_DESC','Enable payment type paysafecard?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_QUICK_TITLE','@Quick');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_QUICK_DESC','Enable payment type @Quick?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_ELV_TITLE','Direct Debit');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_ELV_DESC','Enable payment type Direct Debit?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PAYPAL_TITLE', 'PayPal');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PAYPAL_DESC','Enable payment type Paypal?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SUE_TITLE', 'SOFORT Banking (PIN/TAN)');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SUE_DESC','Enable payment type SOFORT Banking (PIN/TAN)?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_C2P_TITLE', 'CLICK2PAY');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_C2P_DESC','Enable payment type CLICK2PAY?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_IDEAL_TITLE','iDEAL');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_IDEAL_DESC','Enable payment type iDEAL?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_WGP_TITLE','giropay');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_WGP_DESC','Enable payment type Giropay?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INVOICE_TITLE','Invoice');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INVOICE_DESC','Enable payment type Invoice?');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARDMOTO_TITLE','Credit Card Moto');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARDMOTO_DESC','Enable payment type Credit Card without "Verified by Visa" and "MasterCard SecureCode"?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_BMC_TITLE','Bancontact/Mister Cash');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_BMC_DESC','Enable payment type Bancontact/Mister Cash?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EKONTO_TITLE','eKonto');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EKONTO_DESC','Enable payment type eKonto?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTALLMENT_TITLE','Installment');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTALLMENT_DESC','Enable payment type Installment?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTANTBANK_TITLE','Instantbank');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTANTBANK_DESC','Enable payment type InstantBank?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MONETA_TITLE','moneta.ru');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MONETA_DESC','Enable payment type moneta.ru?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_P24_TITLE','Przelewy24');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_P24_DESC','Enable payment type Przelewy24?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_POLI_TITLE','POLi');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_POLI_DESC','Enable payment type POLi?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MPASS_TITLE','mpass');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MPASS_DESC','Enable payment mpass?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLDIRECT_TITLE','Skrill Direct');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLDIRECT_DESC','Enable payment Skrill Direct?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLWALLET_TITLE','Skrill Digital Wallet');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLWALLET_DESC','Enable payment Skrill Digital Wallet?');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MIN_AMOUNT_TITLE','Invoice minimum amount');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MIN_AMOUNT_DESC','Enter minimum amount for invoice. (&euro;)');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MAX_AMOUNT_TITLE','Invoice maximum amount');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MAX_AMOUNT_DESC','Enter maximum amount for invoice. (&euro;)');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MIN_AMOUNT_TITLE','Installment minimum amount');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MIN_AMOUNT_DESC','Enter minimum amount for installment. (&euro;)');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MAX_AMOUNT_TITLE','Installment maximum amount');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MAX_AMOUNT_DESC','Enter maximum amount for installment. (&euro;)');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SERVICEURL_TITLE','ServiceURL');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SERVICEURL_DESC','Enter the URL to your contact page.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_IMAGEURL_TITLE','ImageURL');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_IMAGEURL_DESC','Enter the Url of the image which should be displayed during the payment process on the Wirecard Checkout Page page.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SORT_ORDER_TITLE','Sort order of display');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SORT_ORDER_DESC','Sort order of display. Lowest is displayed first.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ZONE_TITLE','Payment Zone');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ZONE_DESC','If a zone is selected, only enable this payment method for that zone.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_ID_TITLE','Set Order Status');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_ID_DESC','Set the status of orders made with this payment module to this value.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_PENDING_ID_TITLE','Set Order Status Pending');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_PENDING_ID_DESC','Set the status of orders made with this payment module, which are in paymentstate pending.');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYMENT_TITLE', 'Payment process.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_REDIRECTTEXT', 'You will be redirected soon. If not please press continue.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TEXT_DISPLAYTEXT','Thank you for your order.');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARD_TEXT','Credit Card');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MAESTRO_TEXT','Maestro SecureCode');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EPS_TEXT','eps Online Bank Transfer');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PBX_TEXT','Mobile Phone Invoicing');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PSC_TEXT','paysafecard');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_QUICK_TEXT','@Quick');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_ELV_TEXT','Direct Debit');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_IDEAL_TEXT','iDEAL');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PAYPAL_TEXT','PayPal');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_WGP_TEXT','giropay');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_C2P_TEXT','CLICK2PAY');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SUE_TEXT','SOFORT Banking (PIN/TAN)');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INVOICE_TEXT','Invoice');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARDMOTO_TEXT','Credit Card Moto');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_BMC_TEXT','Bancontact/Mister Cash');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EKONTO_TEXT','eKonto');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTALLMENT_TEXT','Installment');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTANTBANK_TEXT','InstantBank');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MONETA_TEXT','moneta.ru');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_P24_TEXT','Przelewy24');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_POLI_TEXT','POLi');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MPASS_TEXT','mpass');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLDIRECT_TEXT','Skrill Direct');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLWALLET_TEXT','Skrill Digital Wallet');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ERROR_TITEL', 'Payment error');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ERROR_NOTRID', 'No transaction id');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CANCEL_TEXT', 'You have aborted the payment process.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PENDING_TEXT', 'The payment confirmation will be sent later.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ERROR_TEXT', 'Your payment was invalid.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_FINGERPRINT_TEXT', 'There was an error during the data check.');