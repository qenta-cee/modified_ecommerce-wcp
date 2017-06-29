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

$lang_array = array(
    'WIRECARDINFO' => <<<HTML
    <a href="https://www.wirecard.at/" target="_blank" title="www.wirecard.at"><img
                class="wirecardcheckoutpage-logo" src="%s" alt="Wirecard"
                border="0"/>
    </a><br/>
    <p class="wirecardcheckoutpage-intro">Wirecard - Ihr Full-Service Payment-Provider - Umfangreiche L&ouml;sungen aus einer Hand</p>
    Wirecard ist einer der weltweit f&uuml;hrenden unabh&auml;ngigen Anbieter von Outsourcing- und White-Label-L&ouml;sungen f&uuml;r 
    den elektronischen Zahlungsverkehr.<br/><br/> Als unabh&auml;ngiger Payment-Anbieter begleiten wir unsere Kunden in 
    allen Phasen der Gesch&auml;ftsentwicklung. Mit ma&szlig;geschneiderten Bezahll&ouml;sungen setzt unser Unternehmen im E-Payment 
    Akzente und ist &Ouml;sterreichs marktf&uuml;hrender Payment Service Provider. Pers&ouml;nlich, kompetent und engagiert.<br/>
    <br/>
    <p><a href="https://guides.wirecard.at/doku.php/plugins_general" target="_blank">Allgemeine Informationen zu den 
    Wirecard Shop-Plugins</a></p>
    <div style="clear:both;"></div>
HTML
,
    'CONFIG_HEADING_TITLE' => 'Wirecard Checkout Page Konfiguration',
    'BACKEND_HEADING_TITLE' => 'Wirecard Checkout Page Backend',
    'TRANSFER_HEADING_TITLE' => 'Wirecard Checkout Page Auszahlung',
    'SUPPORT_HEADING_TITLE' => 'Wirecard Checkout Page Supportanfrage',
    'CONFIGURE' => 'Wirecard Checkout Page Einstellungen',
    'CONFIGURATION_HELP' => "Achtung: Hier k&ouml;nnen nur die zahlungsmittelspezifischen Einstellungen gemacht werden! " .
        "F&uuml;r die globalen Einstellungen, Backendoperationen sowie Anfrage an den Wirecard Support klicken Sie bitte hier: ",
    'ACTIVE' => 'Aktiv',
    'SORT_ORDER' => 'Anzeigereihenfolge',
    'ALLOWED' => 'Erlaubte Zonen',
    'ALLOWED_DESC' => 'Geben Sie erlaubte Zonen ein (e.g. AT, DE)',
    'ZONE' => 'Zahlungszone',
    'ZONE_DESC' => 'Wenn eine Zone ausgew&auml;hlt ist, gilt die Zahlungsmethode nur f&uuml;r diese Zone.',
    'MORE_INFORMATION' => 'Mehr Informationen',
    'BASICDATA' => 'Zugangsdaten',
    'OPTIONS' => 'Allgemeine Einstellungen',
    'CREDITCARDOPTIONS' => 'Kreditkartenoptionen',
    'CONFIG_SAVE' => 'Konfiguration speichern',
    'CONFIG_SUCCESS' => 'Konfiguration erfolgreich gespeichert!',
    'CONFIG_TEST' => 'Konfiguration testen',
    'CONFIG_TEST_OK' => 'Konfigurationstest erfolgreich!',
    'TAB_CONFIG' => 'Konfiguration',
    'TAB_SUPPORT' => 'Supportanfrage',
    'TAB_TX' => 'Transaktionen',
    'TAB_TRANSFER' => 'Auszahlung',
    'VALIDATOR_REQUIRED' => '%s ist erforderlich',
    'VALIDATOR_NUMERIC' => '%s muss ein numerischer Wert sein',
    'VALIDATOR_MAXCHAR' => '%s darf nur %d Zeichen lang sein',
    'FRONTEND_INITERROR' => 'Bei der Verarbeitung der Zahlung ist ein interner Fehler aufgetreten, bitte versuchen Sie es zu einem sp&auml;teren Zeitpunkt erneut!',
    'PENDINGINFO' => 'Ihre Bestellung wird vearbeitet, sobald wir die Zahlungsbest&auml;tigung Ihrer Bank erhalten haben.',
    'GATEWAYREFERENCE' => 'Zahlungsreferenz',
    'CREDITCARD_CARDHOLDER' => 'Karteninhaber',
    'CREDITCARD_PAN' => 'Kartennummer',
    'CREDITCARD_EXPIRY' => 'Ablaufdatum',
    'CREDITCARD_CVC' => 'CVC',
    'CREDITCARD_ISSUEDATE' => 'Ausgabedatum',
    'CREDITCARD_ISSUENUMBER' => 'Ausgabenummer',
    'FINANCIALINSTITUTION' => 'Finanzinstitut',
    'CHOOSE_FINANCIALINSTITUTION' => 'Bitte w&auml;hlen Sie ihr Finanzinstitut aus ...',
    'BIRTHDAY' => 'Geburtstag',
    'PAYOLUTION_CONSENT' => 'Mit der &Uuml;bermittlung der f&uuml;r die Abwicklung des Rechnungskaufes und einer Identit&auml;ts- und Bonit&auml;tspr&uuml;fung erforderlichen Daten an payolution bin ich einverstanden. Meine %s kann ich jederzeit mit Wirkung f&uuml;r die Zukunft widerrufen.',
    'CONSENT' => 'Einwilligung',
    'CONSENT_MSG' => 'Bitte akzeptieren Sie die Zustimmungserkl&auml;rung!',
    'MIN_AGE_MESSAGE' => 'Sie m&uuml;ssen %d Jahre oder &auml;lter sein, um diese Zahlungsart verwenden zu d&uuml;rfen.',
    'VOUCHER_ID' => 'Mein Gutscheincode',
    'GIROPAY_ACCOUNTOWNER' => 'Kontoinhaber',
    'GIROPAY_ACCOUNTNUMBER' => 'Kontonummer',
    'GIROPAY_BANKNUMBER' => 'Bankleitzahl',
    'PAYBOX_NUMBER' => 'Paybox Nummer',
    'SEPA_ACCOUNTOWNER' => 'Kontoinhaber',
    'SEPA_BANKBIC' => 'BIC',
    'SEPA_BANKACCOUNTIBAN' => 'IBAN',
    'SEPA_BANKNAME' => 'Finanzinstitut',
    'TRANSACTIONS_INFO' => 'Es sind keine Transaktionen vorhanden',
    'TABLE_HEADING_ORDER' => 'Bestellung',
    'TABLE_HEADING_ORDERNUMBER' => 'Auftragsnummer',
    'TABLE_HEADING_MODULE' => 'Modul',
    'TABLE_HEADING_PAYMENTMETHOD' => 'Zahlungsart',
    'TABLE_HEADING_PAYMENTSTATE' => 'Bezahlstatus',
    'TABLE_HEADING_GATEWAYREFERENCE' => 'Zahlungsreferenz',
    'TABLE_HEADING_AMOUNT' => 'Betrag',
    'TABLE_HEADING_CURRENCY' => 'W&auml;hrung',
    'TABLE_HEADING_STATUS' => 'Status',
    'TABLE_HEADING_MESSAGE' => 'Info',
    'TRANSACTION' => 'Transaktion',
    'ORDERDETAILS' => 'Auftragsdetails',
    'PAYMENTS' => 'Zahlungen',
    'PAYMENT_NUMBER' => 'Nr',
    'PAYMENT_DATE' => 'Datum',
    'PAYMENT_STATE' => 'Status',
    'PAYMENT_APPROVEDAMOUNT' => 'Genehmigt',
    'PAYMENT_DEPOSITEDAMOUNT' => 'Abgebucht',
    'PAYMENT_OPERATIONS' => 'Operationen',
    'CREDITS' => 'Gutschriften',
    'AMOUNT' => 'Betrag',
    'CURRENCY' => 'W&auml;hrung',
    'FUNDTRANSFER_TYPE' => 'Auszahlungsart',
    'FUNDTRANSFER_TYPE_ORDER' => 'Existierende Zahlung',
    'FUNDTRANSFER_SEND' => 'Auszahlung durchf&uuml;hren',
    'ORDER_DESCRIPTION' => 'Auftragsbeschreibung',
    'CUSTOMER_STATEMENT' => 'Abrechnungstext',
    'ORDERNUMBER' => 'Auftragsummer',
    'SOURCEORDERNUMBER' => 'Quell Auftragsnummer',
    'CREDITNUMBER' => 'Gutschrift-Nr.',
    'ORDERREFERENCE' => 'Auftragsreferenz',
    'CONSUMER_WALLET_ID' => 'Konsumenten Wallet ID',
    'CONSUMER_EMAIL' => 'Konsumenten E-Mail Adresse',
    'SUPPORT_CHANNEL' => 'An',
    'SUPPORT_REPLYTO' => 'Ihre E-Mail Addresse',
    'SUPPORT_MESSAGE' => 'Ihre Nachricht',
    'SUPPORT_SEND' => 'Anfrage senden',
    'SUPPORT_SUCCESS' => 'Anfrage erfolgreich abgesendet!',
    'DATASTORAGE_INITERROR' => 'Der Wirecard Datastore konnte nicht initialisiert werden, bitte versuchen Sie es zu einem sp&auml;teren Zeitpunkt erneut!',
    'CONFIGMODE' => 'Einstellungen',
    'CONFIGMODE_DESC' => 'Zum Testen der Integration eine vordefinierte Konfiguration ausw&auml;hlen. F&uuml;r Produktivsysteme "Production" ausw&auml;hlen.',
    'CUSTOMER_ID_DESC' => 'Ihre Wirecard-Kundennummer (customerId, im Format D2#####).',
    'SHOP_ID_DESC' => 'Shop-Kennung bei mehreren Onlineshops.',
    'SECRET' => 'Secret',
    'SECRET_DESC' => 'Geheime Zeichenfolge, die Sie von Wirecard erhalten haben, zum Signieren und Validieren von Daten zur Pr&uuml;fung der Authentizit&auml;t.',
    'BACKENDPW' => 'Back-end-Passwort',
    'BACKENDPW_DESC' => 'Passwort f&uuml;r Back-end-Operationen (Toolkit).',
    'SERVICE_URL' => 'URL zur Kontakt-Seite',
    'SERVICE_URL_DESC' => 'URL der Kontakt-Seite (Impressum) des Onlineshops.',
    'ORDER_STATUS_SUCCESS' => 'Status f&uuml;r erfolgreiche Zahlungen',
    'ORDER_STATUS_PENDING' => 'Status f&uuml;r ausstehende Zahlungen',
    'ORDER_STATUS_CANCEL' => 'Status f&uuml;r abgebrochene Zahlungen',
    'ORDER_STATUS_FAILURE' => 'Status f&uuml;r fehlgeschlagene Zahlungen',
    'ORDER_STATUS_SUCCESS_DESC' => 'Status f&uuml;r erfolgreiche Zahlungen',
    'ORDER_STATUS_PENDING_DESC' => 'Status f&uuml;r ausstehende Zahlungen',
    'ORDER_STATUS_CANCEL_DESC' => 'Status f&uuml;r abgebrochene Zahlungen',
    'ORDER_STATUS_FAILURE_DESC' => 'Status f&uuml;r fehlgeschlagene Zahlungen',
    'ORDER_CREATION' => 'Bestellung anlegen',
    'ORDER_CREATION_DESC' => 'Falls "Immer" gesetzt ist, werden Bestellungen auch bei fehlgeschlagener Zahlung angelegt. Falls "Nur f&uuml;r erfolgreiche Zahlungen" gesetzt ist, werden Bestellungen nur f&uuml;r erfolgreiche und ausstehende Zahlungen angelegt.',
    'KEEP_PENDING' => 'Ausstehende Zahlungen immer behalten',
    'KEEP_PENDING_DESC' => 'Falls "Ja" gesetzt ist, werden die Bestellungen auch bei fehlgeschlagener Zahlung nicht gel&ouml;scht. Falls "Nein" gesetzt ist, werden diese gel&ouml;scht und fehlen in der Bestellnummern-Reihenfolge. Diese Option zeigt nur Wirkung bei der Einstellung "Nur f&uuml;r erfolgreiche Zahlungen".',
    'SHOPNAME' => 'Shop-Referenz im Buchungstext',
    'SHOPNAME_DESC' => 'Referenz zu Ihrem Onlineshop im Bankauszug f&uuml;r Ihren Kunden, max. 9 Zeichen.',
    'SEND_SHIPPINGDATA' => 'Versanddaten des Konsumenten mitsenden',
    'SEND_SHIPPINGDATA_DESC' => 'Weiterleitung der Versanddaten des Kunden an den Finanzdienstleister.',
    'SEND_BILLINGDATA' => 'Verrechnungsdaten des Konsumenten mitsenden',
    'SEND_BILLINGDATA_DESC' => 'Weiterleitung der Rechnungsdaten des Kunden an den Finanzdienstleister.',
    'SEND_BASKETINFORMATION' => 'Warenkorbdaten des Konsumenten mitsenden',
    'SEND_BASKETINFORMATION_DESC' => 'Weiterleitung des Warenkorbs des Kunden an den Finanzdienstleister.',
    'SENDCONFIRMATIONEMAIL' => 'Benachrichtigungsemail',
    'SENDCONFIRMATIONEMAIL_DESC' => 'Benachrichtigung per E-Mail &uuml;ber Zahlungen Ihrer Kunden, falls ein Kommunikationsproblem zwischen Wirecard und Ihrem Onlineshop aufgetreten ist. Bitte kontaktieren Sie unsere Sales-Teams um dieses Feature freizuschalten.',
    'AUTODEPOSIT' => 'Automatisches Abbuchen',
    'AUTODEPOSIT_DESC' => 'Automatisches Abbuchen der Zahlungen. Bitte kontaktieren Sie unsere Sales-Teams um dieses Feature freizuschalten.',
    'PAYOLUTION_TERMS' => 'payolution Nutzungsbedingungen',
    'PAYOLUTION_TERMS_DESC' => 'Kunden m&uuml;ssen die Nutzungsbedingungen von payolution w&auml;hrend des Bezahlprozesses akzeptieren.',
    'PAYOLUTION_MID' => 'payolution mID',
    'PAYOLUTION_MID_DESC' => 'payolution-H&auml;ndler-ID, Nicht base64 kodiert.',
    'DISPLAYSEPA_BIC' => 'Anzeige des Feldes f&uuml;r SEPA Direct Debit BIC',
    'DISPLAYSEPA_BIC_DESC' => 'Anzeige des Feldes zur Eingabe des SEPA Direct Debit BIC im Formular w&auml;hrend des Bezahlprozesses.',
    'PCI3_DSS_SAQ_A_ENABLE' => 'SAQ A konform',
    'PCI3_DSS_SAQ_A_ENABLE_DESC' => 'Falls "Nein" gesetzt ist, gilt der strengere SAQ A-EP. Falls "Ja" gesetzt ist, wird in Wirecard Checkout Page das "PCI DSS SAQ A Compliance"-Feature verwendet und es gilt der SAQ A.',
    'IFRAME_CSS_URL' => 'Iframe CSS-URL',
    'IFRAME_CSS_URL_DESC' => 'Eingabe des CSS-Dateinamens, um die iFrame-Eingabefelder anzupassen, wenn das "PCI DSS SAQ A Compliance"-Feature verwendet wird.',
    'PAN_PLACEHOLDER' => 'Kartennummer Platzhalter-Text',
    'PAN_PLACEHOLDER_DESC' => 'Platzhalter-Text f&uuml;r Kartennummer-Feld.',
    'DISPLAYEXPIRATIONDATE_PLACEHOLDER' => 'Ablaufdatum Platzhalter-Text anzeigen',
    'DISPLAYEXPIRATIONDATE_PLACEHOLDER_DESC' => 'Platzhalter-Text f&uuml;r Ablaufdatum-Feld.',
    'DISPLAYCARDHOLDER' => 'Anzeige des Feldes f&uuml;r Karteninhaber',
    'DISPLAYCARDHOLDER_DESC' => 'Anzeige des Feldes zur Eingabe des Kreditkarteninhabers im Formular w&auml;hrend des Bezahlprozesses.',
    'CARDHOLDER_PLACEHOLDER' => 'Karteninhaber Platzhalter-Text',
    'CARDHOLDER_PLACEHOLDER_DESC' => 'Platzhalter-Text f&uuml;r Karteninhaber-Feld.',
    'DISPLAYCVC' => 'CVC-Feld anzeigen',
    'DISPLAYCVC_DESC' => 'Anzeige des Feldes zur Eingabe der Kreditkartenpr&uuml;fnummer (CVC) im Formular w&auml;hrend des Bezahlprozesses.',
    'CVC_PLACEHOLDER' => 'CVC Platzhalter-Text anzeigen',
    'CVC_PLACEHOLDER_DESC' => 'Platzhalter-Text f&uuml;r Kreditkartenpr&uuml;fnummer-Feld (CVC).',
    'DISPLAYISSUEDATE' => 'Feld f&uuml;r Ausgabedatum anzeigen',
    'DISPLAYISSUEDATE_DESC' => 'Anzeige des Feldes zu Eingabe des Kredikarten-Ausgabedatums im Formular w&auml;hrend des Bezahlprozesses.',
    'DISPLAYISSUEDATE_PLACEHOLDER' => 'Ausgabedatum Platzhalter-Text anzeigen',
    'DISPLAYISSUEDATE_PLACEHOLDER_DESC' => 'Anzeige des Platzhalter-Textes f&uuml;r das Ausgabedatum-Feld.',
    'DISPLAYISSUENUMBER' => 'Feld f&uuml;r Ausgabenummer anzeigen',
    'DISPLAYISSUENUMBER_DESC' => 'Anzeige des Feldes zur Eingabe des Kreditkarten-Ausgabedatums im Formular w&auml;hrend des Bezahlprozesses.',
    'ISSUENUMBER_PLACEHOLDER' => 'Ausgabenummer Platzhalter-Text anzeigen',
    'ISSUENUMBER_PLACEHOLDER_DESC' => 'Platzhalter-Text f&uuml;r das Ausgabenummer-Feld anzeigen.',
    'REDIRECTION_HEADER' => 'Sie werden nun weitergeleitet.',
    'REDIRECTION_TEXT' => 'Falls Sie nicht weitergeleitet werden, klicken Sie bitte ',
    'REDIRECTION_HERE' => 'hier.',

);


// define 
foreach ($lang_array as $key => $val) {
    $key = 'TEXT_WIRECARDCHECKOUTPAGE_' . $key;
    defined($key) or define($key, $val);
}


