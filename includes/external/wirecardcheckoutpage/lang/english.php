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
    'WIRECARDINFO' => '    <a href="https://www.wirecard.at/" target="_blank" title="www.wirecard.at"><img
                class="wirecardcheckoutpage-logo" src="%s" alt="Wirecard"
                border="0"/>
    </a><br/>
    <p class="wirecardcheckoutpage-intro">Wirecard - Your Full Service Payment Provider - Comprehensive
        solutions from one single source</p>
    Wirecard is among the independent global leaders in outsourcing and white label solutions for electronic payment 
    transactions.<br/><br/> As an independent supplier of payment solutions, we support our customers at every step 
    of their business development. Our custom-tailored payment solutions are benchmark leaders in e-payment methods 
    and have made us Austria\'s leading payment service provider. Customized, competent and committed. <br/>
    <br/>
    <p><a href="https://guides.wirecard.at/doku.php/plugins_general" target="_blank">General information regarding
            Wirecard Shop Plugins</a></p>
    <div style="clear:both;"></div>',
    'CONFIG_HEADING_TITLE' => 'Wirecard Checkout Page Configuration',
    'BACKEND_HEADING_TITLE' => 'Wirecard Checkout Page Backend',
    'TRANSFER_HEADING_TITLE' => 'Wirecard Checkout Page Fund transfer',
    'SUPPORT_HEADING_TITLE' => 'Wirecard Checkout Page Support request',
    'CONFIGURE' => 'Wirecard Checkout Page Configuration',
    'CONFIGURATION_HELP' => "Warning: You can only make per paymenttype settings here! " .
        "For global plugin settings, backendoperations and Wirecard support request. Please click here: ",
    'ACTIVE' => 'Active',
    'SORT_ORDER' => 'Display order',
    'ALLOWED' => 'Allowed zones',
    'ALLOWED_DESC' => 'Enter allowed zones (e.g. AT, DE)',
    'ZONE' => 'Payment zone',
    'ZONE_DESC' => 'Selected payment method is available for this zone only.',
    'CONFIGMODE' => 'Configuration',
    'MORE_INFORMATION' => 'More information',
    'BASICDATA' => 'Access Data',
    'OPTIONS' => 'General Settings',
    'CREDITCARDOPTIONS' => 'Credit Card options',
    'CONFIG_SAVE' => 'Save configuration',
    'CONFIG_SUCCESS' => 'Configuration saved successfully!',
    'CONFIG_TEST' => 'Test Configuration',
    'CONFIG_TEST_OK' => 'Configurationtest succeeded!',
    'TAB_CONFIG' => 'Configuration',
    'TAB_SUPPORT' => 'Contact support',
    'TAB_TX' => 'Transactions',
    'TAB_TRANSFER' => 'Fund transfer',
    'VALIDATOR_REQUIRED' => '%s is required',
    'VALIDATOR_NUMERIC' => '%s must be a numeric value',
    'VALIDATOR_MAXCHAR' => '%s has a max length of %d chars',
    'FRONTEND_INITERROR' => 'An internal error occurred during the payment process, please try again later!',
    'PENDINGINFO' => 'Your order will be processed as soon as we receive the payment confirmation from your bank.',
    'GATEWAYREFERENCE' => 'Payment reference',
    'CREDITCARD_CARDHOLDER' => 'Card holder',
    'CREDITCARD_PAN' => 'Credit card number',
    'CREDITCARD_EXPIRY' => 'Expiration date',
    'CREDITCARD_CVC' => 'Card verification code',
    'CREDITCARD_ISSUEDATE' => 'Issue date',
    'CREDITCARD_ISSUENUMBER' => 'Issue number',
    'FINANCIALINSTITUTION' => 'Financial institution',
    'CHOOSE_FINANCIALINSTITUTION' => 'Choose your bank ...',
    'BIRTHDAY' => 'Birthday',
    'PAYOLUTION_CONSENT' => 'I agree that the data which are necessary for the liquidation of purchase on account and which are used to complete the identity and credit check are transmitted to payolution. My %s can be revoked at any time with effect for the future.',
    'CONSENT' => 'consent',
    'CONSENT_MSG' => 'Please accept the consent!',
    'MIN_AGE_MESSAGE' => "You have to be %d years or older to use this payment.",
    'VOUCHER_ID' => 'My Voucher Id',
    'GIROPAY_ACCOUNTOWNER' => 'Account owner',
    'GIROPAY_ACCOUNTNUMBER' => 'Account number',
    'GIROPAY_BANKNUMBER' => 'Bank number',
    'PAYBOX_NUMBER' => 'Paybox number',
    'SEPA_ACCOUNTOWNER' => 'Account owner',
    'SEPA_BANKBIC' => 'BIC',
    'SEPA_BANKACCOUNTIBAN' => 'IBAN',
    'SEPA_BANKNAME' => 'Bank name',
    'TRANSACTIONS_INFO' => 'No Transactions available',
    'TABLE_HEADING_ORDER' => 'Order',
    'TABLE_HEADING_ORDERNUMBER' => 'Order number',
    'TABLE_HEADING_MODULE' => 'Module',
    'TABLE_HEADING_PAYMENTMETHOD' => 'Paymenttype',
    'TABLE_HEADING_PAYMENTSTATE' => 'Paymentstate',
    'TABLE_HEADING_GATEWAYREFERENCE' => 'Gateway reference',
    'TABLE_HEADING_AMOUNT' => 'Amount',
    'TABLE_HEADING_CURRENCY' => 'Currency',
    'TABLE_HEADING_STATUS' => 'Status',
    'TABLE_HEADING_MESSAGE' => 'Message',
    'TRANSACTION' => 'Transaction',
    'ORDERDETAILS' => 'Orderdetails',
    'PAYMENTS' => 'Payments',
    'PAYMENT_NUMBER' => 'Nr',
    'PAYMENT_DATE' => 'Date',
    'PAYMENT_STATE' => 'State',
    'PAYMENT_APPROVEDAMOUNT' => 'Approved',
    'PAYMENT_DEPOSITEDAMOUNT' => 'Deposited',
    'PAYMENT_OPERATIONS' => 'Operations',
    'CREDITS' => 'Credits',
    'AMOUNT' => 'Amount',
    'CURRENCY' => 'Currency',
    'FUNDTRANSFER_TYPE' => 'Fundtransfer type',
    'FUNDTRANSFER_TYPE_ORDER' => 'Existing order',
    'FUNDTRANSFER_SEND' => 'Transmit fund transfer',
    'ORDER_DESCRIPTION' => 'Order description',
    'CUSTOMER_STATEMENT' => 'Customer statement',
    'ORDERNUMBER' => 'Order number',
    'SOURCEORDERNUMBER' => 'Source order number',
    'CREDITNUMBER' => 'Credit number',
    'ORDERREFERENCE' => 'Order reference',
    'CONSUMER_WALLET_ID' => 'Consumer wallet ID',
    'CONSUMER_EMAIL' => 'Consumer e-mail address',
    'SUPPORT_CHANNEL' => 'To',
    'SUPPORT_REPLYTO' => 'Your e-mail address',
    'SUPPORT_MESSAGE' => 'Your message',
    'SUPPORT_SEND' => 'Send support request',
    'SUPPORT_SUCCESS' => 'Support request sent successfully!',
    'DATASTORAGE_INITERROR' => 'Could not initiate Wirecard data store, please try again later!',
    'CONFIGMODE' => 'Configuration',
    'CONFIGMODE_DESC' => 'For integration, select predefined configuration settings or "Production" for live systems',
    'SECRET' => 'Secret',
    'SECRET_DESC' => 'String which you received from Wirecard for signing and validating data to prove their authenticity.',
    'BACKEND_PW' => 'Back-end password',
    'SERVICE_URL' => 'URL to contact page',
    'ORDER_STATUS_SUCCESS' => 'Status successfull payment',
    'ORDER_STATUS_PENDING' => 'Status pending payment',
    'ORDER_STATUS_CANCEL' => 'Status cancelled payment',
    'ORDER_STATUS_FAILURE' => 'Status failed payment',
    'ORDER_CREATION' => 'Create orders',
    'KEEP_PENDING' => 'Always keep pending payments',
    'SHOPNAME' => 'Shop reference in posting text',
    'SEND_SHIPPINGDATA' => 'Forward consumer shipping data',
    'SEND_BILLINGDATA' => 'Forward consumer billing data',
    'SEND_BASKETINFORMATION' => 'Forward basket data',
    'SENDCONFIRMATIONEMAIL' => 'Notification e-mail',
    'AUTODEPOSIT' => 'Automated deposit',
    'PAYOLUTION_TERMS' => 'payolution terms',
    'PAYOLUTION_MID' => 'payolution mID',
    'PCI3_DSS_SAQ_A_ENABLE' => 'SAQ A compliance',
    'IFRAME_CSS_URL' => 'Iframe CSS-URL',
    'PAN_PLACEHOLDER' => 'Credit card number placeholder text',
    'DISPLAYEXPIRATIONDATE_PLACEHOLDER' => 'Display expiration date placeholder text',
    'DISPLAYCARDHOLDER' => 'Display card holder field',
    'CARDHOLDER_PLACEHOLDER' => 'Card holder placeholder text',
    'DISPLAYCVC' => 'Display CVC field',
    'CVC_PLACEHOLDER' => 'CVC placeholder text',
    'DISPLAYISSUEDATE' => 'Display issue date field',
    'DISPLAYISSUEDATE_PLACEHOLDER' => 'Display issue date placeholder text',
    'DISPLAYISSUENUMBER' => 'Display issue number field',
    'ISSUENUMBER_PLACEHOLDER' => 'Issue number placeholder text',
    'REDIRECTION_HEADER' => 'You will be redirected in a moment.',
    'REDIRECTION_TEXT' => 'If the redirect does not work please click ',
    'REDIRECTION_HERE' => 'here.',
);


// define 
foreach ($lang_array as $key => $val) {
    $key = 'TEXT_WIRECARDCHECKOUTPAGE_' . $key;
    defined($key) or define($key, $val);
}
