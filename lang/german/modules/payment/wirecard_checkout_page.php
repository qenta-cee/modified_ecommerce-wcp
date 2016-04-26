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
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TEXT_DESCRIPTION', 'Wirecard Checkout Page<br>Zus&auml;tzliche Informationen &uuml;ber WirecardCEE-Produkte erhalten Sie unter http://www.wirecard.at');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_STATUS_TITLE','Wirecard Checkout Page Modul aktivieren');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_STATUS_DESC','M&ouml;chten Sie Zahlungen &uuml;ber Wirecard Checkout Page akzeptieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CUSTOMERID_TITLE','Kundennummer');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CUSTOMERID_DESC','Geben Sie Ihre WirecardCEE-Kundennummer ein.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SHOPID_TITLE','Shop ID');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SHOPID_DESC','Geben Sie Ihre WirecardCEE-shopID ein.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SECRET_TITLE','Secret');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SECRET_DESC','Geben Sie den Secret (preshared key) f&uuml;r die Fingerprint-&Uuml;berpr&uuml;fung ein, den Sie von WirecardCEE erhalten haben.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_USE_IFRAME_TITLE','IFrame verwenden');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_USE_IFRAME_DESC','Startet den Wirecard Checkout Page Zahlungsprocess in einem IFrame innerhalb des Shops');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SELECT_TITLE','Zahlungsoption SELECT');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SELECT_DESC','Die Zahlungsmittelauswahl erfolgt auf der Wirecard Checkout Page. Wenn aktiviert, werden keine weiteren Zahlungsmodule der Wirecard Checkout Page im Shop angezeigt.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_TEXT_TITLE','Zahlungsoptionstext');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_TEXT_DESC','Geben Sien den Text an, der als Beschreibung f&uuml;r die Zahlungsoption SELECT dargestellt werden soll (zB MasterCard, Visa, ...).');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARD_TITLE','Kreditkarte');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARD_DESC','Zahlungsoption Kreditkarte aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MAESTRO_TITLE','Maestro SecureCode');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MAESTRO_DESC','Zahlungsoption Maestro SecureCode aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EPS_TITLE','eps Online-&Uuml;berweisung');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EPS_DESC','Zahlungsoption eps Online-&Uuml;berweisung aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PBX_TITLE','Handyabrechnung');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PBX_DESC','Zahlungsoption Handyabrechnung aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PSC_TITLE','paysafecard');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PSC_DESC','Zahlungsoption paysafecard aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_QUICK_TITLE','@Quick');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_QUICK_DESC','Zahlungsoption @Quick aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_ELV_TITLE','Lastschriftverfahren');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_ELV_DESC','Zahlungsoption Lastschriftverfahren aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PAYPAL_TITLE', 'PayPal');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PAYPAL_DESC','Zahlungsoption Paypal aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SUE_TITLE', 'SOFORT &Uuml;berweisung (PIN/TAN)');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SUE_DESC','Zahlungsoption SOFORT &Uuml;berweisung (PIN/TAN) aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_C2P_TITLE', 'CLICK2PAY');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_C2P_DESC','Zahlungsoption CLICK2PAY aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_IDEAL_TITLE','iDEAL');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_IDEAL_DESC','Zahlungsoption iDEAL aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_WGP_TITLE','giropay');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_WGP_DESC','Zahlungsoption giropay aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INVOICE_TITLE','Rechnung');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INVOICE_DESC','Zahlungsoption Rechnung aktivieren?');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARDMOTO_TITLE','Kreditkarte Moto');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARDMOTO_DESC','Kreditkartenzahlung ohne "Verified by Visa" und "MasterCard SecureCode"?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_BMC_TITLE','Bancontact/Mister Cash');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_BMC_DESC','Zahlungsoption Bancontact/Mister Cash aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EKONTO_TITLE','eKonto');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EKONTO_DESC','Zahlungsoption type eKonto aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTALLMENT_TITLE','Ratenzahlung');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTALLMENT_DESC','Zahlungsoption Ratenzahlung aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTANTBANK_TITLE','InstantBank');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTANTBANK_DESC','Zahlungsoption InstantBank aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MONETA_TITLE','moneta.ru');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MONETA_DESC','Zahlungsoption moneta.ru aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_P24_TITLE','Przelewy24');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_P24_DESC','Zahlungsoption Przelewy24 aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_POLI_TITLE','POLi');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_POLI_DESC','Zahlungsoption POLi aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MPASS_TITLE','mpass');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MPASS_DESC','Zahlungsoption mpass aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLDIRECT_TITLE','Skrill Direct');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLDIRECT_DESC','Zahlungsoption Skrill Direct aktivieren?');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLWALLET_TITLE','Skrill Digital Wallet');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLWALLET_DESC','Zahlungsoption Skrill Digital Wallet aktivieren?');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MIN_AMOUNT_TITLE','Minimalbetrag Kauf auf Rechnung');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MIN_AMOUNT_DESC','Geben sie den Minimalbetrag f&uuml;r Kauf auf Rechnung an.  (&euro;)');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MAX_AMOUNT_TITLE','Maximalbetrag Kauf auf Rechnung');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MAX_AMOUNT_DESC','Geben sie den Maximalbetrag f&uuml;r Kauf auf Rechnung an.  (&euro;)');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MIN_AMOUNT_TITLE','Minimalbetrag Ratenzahlung');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MIN_AMOUNT_DESC','Geben sie den Minimalbetrag f&uuml;r Ratenzahlung an.  (&euro;)');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MAX_AMOUNT_TITLE','Maximalbetrag Ratenzahlung');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MAX_AMOUNT_DESC','Geben sie den Maximalbetrag f&uuml;r Ratenzahlung an.  (&euro;)');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SERVICEURL_TITLE','ServiceURL');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SERVICEURL_DESC','Geben Sie die Url zu ihrer Kontaktseite ein..');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_IMAGEURL_TITLE','ImageURL');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_IMAGEURL_DESC','Geben Sie die Url der Grafik ein, die w&auml;hrend dem Bezahlvorgang auf Wirecard Checkout Page angezeigt werden soll.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SORT_ORDER_TITLE','Anzeigereihenfolge');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SORT_ORDER_DESC','Reihenfolge der Anzeige. Kleinste Ziffer wird zuerst angezeigt.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ZONE_TITLE','Zahlungszone');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ZONE_DESC','Wenn eine Zone ausgew&auml;hlt ist, gilt die Zahlungsmethode nur f&uuml;r diese Zone.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_ID_TITLE','Bestellstatus festlegen');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_ID_DESC','Bestellungen, welche mit diesem Modul gemacht werden, auf diesen Status setzen.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_PENDING_ID_TITLE','Bestellstatus für ausstehende Zahlungen festlegen');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_PENDING_ID_DESC','Bestellungen, welche mit diesem Modul gemacht werden und im Bezahlstatus pending sind, auf diesen Status setzen.');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYMENT_TITLE', 'Bezahlvorgang');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_REDIRECTTEXT', 'Sie werden in k&uuml;rze Weitergeleitet. Wenn nicht dr&uuml;cken sie bitte auf den Button mit der Aufschrift "Weiter"');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TEXT_DISPLAYTEXT','Herzlichen Dank fuer Ihre Bestellung.');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARD_TEXT','Kreditkarte');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MAESTRO_TEXT','Maestro SecureCode');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EPS_TEXT','eps Online-&Uuml;berweisung');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PBX_TEXT','Handyabrechnung');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PSC_TEXT','paysafecard');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_QUICK_TEXT','@Quick');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_ELV_TEXT','Lastschriftverfahren');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_IDEAL_TEXT','iDEAL');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PAYPAL_TEXT','PayPal');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_WGP_TEXT','giropay');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_C2P_TEXT','CLICK2PAY');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SUE_TEXT','sofort&uuml;berweisung.de');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INVOICE_TEXT','Rechnung');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARDMOTO_TEXT','Kreditkarte Moto');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_BMC_TEXT','Bancontact/Mister Cash');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EKONTO_TEXT','eKonto');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTALLMENT_TEXT','Ratenzahlung');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTANTBANK_TEXT','InstantBank');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MONETA_TEXT','moneta.ru');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_P24_TEXT','Przelewy24');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_POLI_TEXT','POLi');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MPASS_TEXT','mpass');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLDIRECT_TEXT','Skrill Direct');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLWALLET_TEXT','Skrill Digital Wallet');

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ERROR_TITEL', 'Zahlungsfehler');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ERROR_NOTRID', 'Keine Transaktions-Id vorhanden');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CANCEL_TEXT', 'Sie haben die Zahlung abgebrochen.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PENDING_TEXT', 'Die Zahlungsfreigabe erfolgt zu einem späteren Zeitpunkt.');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ERROR_TEXT', 'Ihre Zahlung war leider ung&uuml;ltig!');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_FINGERPRINT_TEXT', 'Die Daten&uuml;berpr&uuml;fung ist leider fehlgeschlagen.');

?>