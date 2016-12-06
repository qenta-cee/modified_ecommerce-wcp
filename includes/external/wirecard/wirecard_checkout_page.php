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

  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TRANSACTION_TABLE','wirecard_checkout_page_transaction');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_RETURN', 'callback/wirecard/checkout_page_return.php');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CONFIRM', 'callback/wirecard/checkout_page_confirm.php');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INITIATION_URL','https://checkout.wirecard.com/page/init.php');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_IFRAME','checkout_wirecard_checkout_page.php');
  define('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PLUGINVERSION', '1.1.3');

class wirecard_checkout_page {
    var $code, $title, $description, $enabled, $transaction_id;

    /**
     * confirmation debug-log.
     * Use this for debug useage only!
     * @param $message
     */
    function debug_log( $message )
    {
        file_put_contents('wirecard_checkout_page_notify_debug.txt', date('Y-m-d H:i:s') . ' ' . $message . "\n", FILE_APPEND);
    }

    // class constructor
    function wirecard_checkout_page()
    {
        global $order, $language;

        $this->code           = 'wirecard_checkout_page';
        $this->title          = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TEXT_TITLE;
        $this->description    = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TEXT_DESCRIPTION;
        $this->displaytext    = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TEXT_DISPLAYTEXT;
        $this->sort_order     = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SORT_ORDER;
        $this->enabled        = ((MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_STATUS == 'True') ? true : false);

        $this->transaction_id = '';

        if ((int)MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_ID > 0)
        {
            $this->order_status = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_ID;
        }

        if ((int)MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_PENDING_ID > 0)
        {
            $this->order_status_pending = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_PENDING_ID;
        } else {
            $this->order_status_pending = 1;
        }

        if (is_object($order))
        {
            $this->update_status();
        }
        if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_USE_IFRAME == 'True')
        {
            $this->form_action_url = xtc_href_link(MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_IFRAME,'','SSL');
        }
        else
        {
            $this->form_action_url = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INITIATION_URL;
        }
    }

    ////
    // Status update
    function update_status()
    {
        global $order;

        if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ZONE > 0) )
        {
            $check_flag = false;
            $check_query = xtc_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_IEB_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
            while ($check = xtc_db_fetch_array($check_query))
            {
                if ($check['zone_id'] < 1)
                {
                    $check_flag = true;
                    break;
                }
                elseif ($check['zone_id'] == $order->billing['zone_id'])
                {
                    $check_flag = true;
                    break;
                }
            }

            if ($check_flag == false)
            {
                $this->enabled = false;
            }
            $order->info['order_status'] = $this->order_status;
        }
    }

    // class methods
    function javascript_validation()
    {
        return false;
    }

    function selection()
    {
        if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SELECT == 'True')
        {
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_TEXT == '')
            {
                return array('id' => $this->code,
                             'module' => $this->title);
            }
            else
            {
                return array('id' => $this->code,
                             'module' => $this->title,
                             'fields' => array(array('title' => '', 'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_TEXT)));
            }
        }
        else
        {
            // we have to use a JavaScript helper function to select the main-payment type if a sub type was selected
            $subTypes = array();
            $jsHelper = 'onClick="for (var i = 0; i < document.forms.length; i++) { var form = document.forms[i]; for (var j = 0; j < form.elements.length; j++) { var element = form.elements[j]; if (element.value ==  \'' . $this->code . '\' && element.type == \'radio\') { element.checked = true; break; }}}";';

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARD == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'CCARD', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARD_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MAESTRO == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'MAESTRO', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MAESTRO_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EPS == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'EPS', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EPS_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_IDEAL == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'IDL', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_IDEAL_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_WGP == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'GIROPAY', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_WGP_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SUE == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'SOFORTUEBERWEISUNG', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SUE_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PBX == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'PBX', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PBX_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PSC == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'PSC', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PSC_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_QUICK == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'QUICK', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_QUICK_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PAYPAL == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'PAYPAL', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PAYPAL_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_ELV == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'ELV', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_ELV_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_C2P == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'C2P', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_C2P_TEXT);
            }

            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INVOICE == 'True')
            {
                if($this->_preInvoiceCheck()) {
                    $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'INVOICE', false, $jsHelper),
                                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INVOICE_TEXT);
                }
            }
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARDMOTO == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'CCARD-MOTO', false, $jsHelper),
                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARDMOTO_TEXT);
            }
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_BMC == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'BANCONTACT_MISTERCASH', false, $jsHelper),
                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_BMC_TEXT);
            }
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EKONTO == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'EKONTO', false, $jsHelper),
                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EKONTO_TEXT);
            }
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTALLMENT == 'True')
            {
                if($this->_preInstallmentCheck()) {
                    $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'INSTALLMENT', false, $jsHelper),
                        'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTALLMENT_TEXT);
                }
            }
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTANTBANK == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'INSTANTBANK', false, $jsHelper),
                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTANTBANK_TEXT);
            }
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MONETA == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'MONETA', false, $jsHelper),
                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MONETA_TEXT);
            }
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_P24 == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'PRZELEWY24', false, $jsHelper),
                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_P24_TEXT);
            }
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_POLI == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'POLI', false, $jsHelper),
                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_POLI_TEXT);
            }
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MPASS == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'MPASS', false, $jsHelper),
                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MPASS_TEXT);
            }
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLDIRECT == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'SKRILLDIRECT', false, $jsHelper),
                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLDIRECT_TEXT);
            }
            if (MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLWALLET == 'True')
            {
                $subTypes[] = array('title' => xtc_draw_radio_field('wirecard_checkout_page', 'SKRILLWALLET', false, $jsHelper),
                    'field' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLWALLET_TEXT);
            }


            return array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => $subTypes);
        }
    }

    /*
     * @return bool
     */
    function _preInvoiceCheck() {
        global $order, $customer, $xtPrice;

        $consumerID = xtc_session_is_registered('customer_id') ? $_SESSION['customer_id'] : "";

        $currency = $order->info['currency'];
        $total = $order->info['total'];
        $amount = round($xtPrice->xtcCalculateCurrEx($total,$currency), $xtPrice->get_decimal_places($currency));
        
        $sql = 'SELECT (COUNT(*) > 0) as cnt FROM ' . TABLE_CUSTOMERS .' WHERE DATEDIFF(NOW(), customers_dob) > 6574 AND customers_id="'.$consumerID.'"';

        $result = mysql_fetch_assoc(xtc_db_query($sql));
        
        $ageCheck = (bool) $result['cnt'];
        $country_code = $order->billing['country']['iso_code_2'];    

        return ($ageCheck &&
        ($amount >= MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MIN_AMOUNT && $amount <= MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MAX_AMOUNT ) &&
        ($currency == 'EUR') &&
        (in_array($country_code, Array('AT', 'DE', 'CH'))) &&
        ($order->delivery === $order->billing));
       
    }

    /*
     * @return bool
     */
    function _preInstallmentCheck() {
        global $order, $customer, $xtPrice;

        $consumerID = xtc_session_is_registered('customer_id') ? $_SESSION['customer_id'] : "";

        $currency = $order->info['currency'];
        $total = $order->info['total'];
        $amount = round($xtPrice->xtcCalculateCurrEx($total,$currency), $xtPrice->get_decimal_places($currency));

        $sql = 'SELECT (COUNT(*) > 0) as cnt FROM ' . TABLE_CUSTOMERS .' WHERE DATEDIFF(NOW(), customers_dob) > 6574 AND customers_id="'.$consumerID.'"';
        $result = mysql_fetch_assoc(xtc_db_query($sql));

        $ageCheck = (bool) $result['cnt'];
        $country_code = $order->billing['country']['iso_code_2'];

        return ($ageCheck &&
            ($amount >= MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MIN_AMOUNT && $amount <= MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MAX_AMOUNT ) &&
            ($currency == 'EUR') &&
            (in_array($country_code, Array('AT', 'DE', 'CH'))) &&
            ($order->delivery === $order->billing));

    }


    function pre_confirmation_check()
    {
        return false;
    }

    function confirmation()
    {
        return false;
    }

    function process_button()
    {
        global $order, $order_total_modules, $currency, $xtPrice, $session_started;

        $qLanguage = $_SESSION['language_code'];

        if ($qLanguage == "us")
        {
            $qLanguage = "en";
        }

        $qCurrency = $order->info['currency'];

        $this->transaction_id = $this->generate_trid();

        // construct the orderDescription -> displayed within Payment Center
        // substitute some special characters
        $orderDescription = $this->transaction_id . ' - ' .
                          $order->customer['firstname'] . ' ' .
                          $order->customer['lastname'];

        // construct the amount value
        $total = $order->info['total'];
        if ($_SESSION['customers_status']['customers_status_show_price_tax'] == 0 && $_SESSION['customers_status']['customers_status_add_tax_ot'] == 1)
        {
            $total += $order->info['tax'];
        }
        $amount = round($xtPrice->xtcCalculateCurrEx($total,$qCurrency), $xtPrice->get_decimal_places($qCurrency));

        // construct the returnUrl. we will use one url for all types of return (success, cancel, failure)
        // FILENAME_CHECKOUT_PROCESS
        $returnUrl = xtc_href_link(MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_RETURN, '', 'SSL', true, false);
        $confirmUrl = xtc_href_link(MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CONFIRM, 'confirm=true', 'SSL', true, false);

        // construct the real payment type. if subtype is submittet via post, we have to use them
        $paymentType = (isset($_POST["wirecard_checkout_page"]) && xtc_not_null($_POST["wirecard_checkout_page"])) ? $_POST["wirecard_checkout_page"] : "SELECT";
        $shopVersion = PROJECT_VERSION;
        $pluginVersion =  base64_encode('modified-eCommerce; ' . $shopVersion . '; ; modified-eCommerce; '. MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PLUGINVERSION);

        //add consumerInformation for address verification.
        if(xtc_session_is_registered('customer_id'))
        {
            $consumerID = $_SESSION['customer_id'];
        }
        else
        {
            $consumerID = '';
        }
        $deliveryInformation = $order->delivery;
        if($deliveryInformation['country']['iso_code_2'] == 'US' || $deliveryInformation['country']['iso_code_2'] == 'CA')
        {
            $deliveryState = $this->_getZoneCodeByName($deliveryInformation['state']);
        }
        else
        {
            $deliveryState = $deliveryInformation['state'];
        }
        $billingInformation  = $order->billing;
        if($billingInformation['country']['iso_code_2'] == 'US' || $billingInformation['country']['iso_code_2'] == 'CA')
        {
            $billingState = $this->_getZoneCodeByName($billingInformation['state']);
        }
        else
        {
            $billingState = $billingInformation['state'];
        }

        $sql = 'SELECT customers_dob, customers_fax FROM ' . TABLE_CUSTOMERS .' WHERE customers_id="'.$consumerID.'" LIMIT 1;';
        $result = xtc_db_query($sql);
        $consumerInformation = mysql_fetch_assoc($result);
        if($consumerInformation['customers_dob'] != '0000-00-00 00:00:00')
        {
            $consumerBirthDateTimestamp = strtotime($consumerInformation['customers_dob']);
            $consumerBirthDate = date('Y-m-d', $consumerBirthDateTimestamp);
        }
        else
        {
            $consumerBirthDate = '';
        }

        $postData = Array('customerId'                  => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CUSTOMERID,
                          'shopId'                        => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SHOPID,
                          'imageURL'                    => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_IMAGEURL,
                          'amount'                        => $amount,
                          'paymentType'                    => $paymentType,
                          'currency'                    => $qCurrency,
                          'language'                    => $qLanguage,
                          'orderDescription'            => $orderDescription,
                          'displayText'                    => $this->displaytext,
                          'successURL'                    => $returnUrl,
                          'failureURL'                    => $returnUrl,
                          'cancelURL'                    => $returnUrl,
                          'pendingURL'                    => $returnUrl,
                          'confirmURL'                    => $confirmUrl,
                          'serviceURL'                    => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SERVICEURL,
                          'trid'                        => $this->transaction_id,
                          'pluginVersion'                => $pluginVersion,
                          'consumerShippingFirstName'   => $deliveryInformation['firstname'],
                          'consumerShippingLastName'    => $deliveryInformation['lastname'],
                          'consumerShippingAddress1'    => $deliveryInformation['street_address'],
                          'consumerShippingAddress2'    => $deliveryInformation['suburb'],
                          'consumerShippingCity'        => $deliveryInformation['city'],
                          'consumerShippingZipCode'        => $deliveryInformation['postcode'],
                          'consumerShippingState'        => $deliveryState,
                          'consumerShippingCountry'        => $deliveryInformation['country']['iso_code_2'],
                          'consumerShippingPhone'        => $order->customer['telephone'],
                          'consumerBillingFirstName'    => $billingInformation['firstname'],
                          'consumerBillingLastName'        => $billingInformation['lastname'],
                          'consumerBillingAddress1'        => $billingInformation['street_address'],
                          'consumerBillingAddress2'        => $billingInformation['suburb'],
                          'consumerBillingCity'            => $billingInformation['city'],
                          'consumerBillingZipCode'        => $billingInformation['postcode'],
                          'consumerBillingState'        => $billingState,
                          'consumerBillingCountry'        => $billingInformation['country']['iso_code_2'],
                          'consumerBillingPhone'        => $order->customer['telephone'],
                          'consumerEmail'                => $order->customer['email_address'],
                          'consumerMerchantCrmId'        => md5($order->customer['email_address']),
                          'consumerBirthDate'            => $consumerBirthDate );

        $requestFingerprintOrder = 'secret';
        $tempArray = array('secret' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SECRET);
        foreach ($postData AS $parameterName => $parameterValue) {
            $requestFingerprintOrder .= ',' . $parameterName;
            $tempArray[(string)$parameterName] = (string)$parameterValue;
        }
        $requestFingerprintOrder .= ',requestFingerprintOrder';
        $tempArray['requestFingerprintOrder'] = $requestFingerprintOrder;

        $hash = hash_init('sha512', HASH_HMAC, MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SECRET);
        foreach ($tempArray as $key => $value) {
            hash_update($hash, $value);
        }

        $postData['requestFingerprintOrder'] = $requestFingerprintOrder;
        $postData['requestFingerprint'] = hash_final($hash);

        $result = xtc_db_query("INSERT INTO " . MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TRANSACTION_TABLE . " (TRID, PAYSYS, DATE) VALUES ('" . $this->transaction_id . "', '" . $paymentType . "', NOW())");

        $process_button_string = '';
        foreach($postData AS $parameterName => $parameterValue)
        {
            $process_button_string .= xtc_draw_hidden_field($parameterName, $parameterValue);
        }
        if(MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_USE_IFRAME == 'True')
        {
            $_SESSION['wirecard_checkout_page']['paypage_title'] = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYMENT_TITLE;
            $_SESSION['wirecard_checkout_page']['paypage_redirecttext'] = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_REDIRECTTEXT;
            $_SESSION['wirecard_checkout_page']['form'] = $process_button_string;
            $_SESSION['wirecard_checkout_page']['iFrame'] = true;
            return '';
        }
        else
        {
            return $process_button_string;
        }
    }

    function before_process()
    {
        global $order;

        if(get_magic_quotes_gpc() || get_magic_quotes_runtime())
        {
            $this->debug_log('magic_quotes enabled. Stripping slashes.');
            foreach($_POST AS $key=>$value)
            {
                $responseArray[$key] = stripslashes($value);
            }
        }
        else
        {
            $responseArray = $_POST;
        }

        if(isset($responseArray['trid']) && trim($responseArray['trid']) != '')
        {
            $this->transaction_id = $responseArray['trid'];
        }
        else
        {
            $redirectUrl = xtc_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=wirecard_checkout_page&message=' . MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ERROR_NOTRID, 'SSL', true, false);
            xtc_redirect($redirectUrl);
        }

        $orderDesc            = isset($responseArray['orderDesc']) ? $responseArray['orderDesc'] : '';
        // orderNumber is only given if paymentState=success
        $orderNumber          = isset($responseArray['orderNumber']) ? $responseArray['orderNumber'] : 0;
        $paymentState         = isset($responseArray['paymentState']) ? $responseArray['paymentState'] : 'FAILURE';
        $paysys               = isset($responseArray['paymentType']) ? $responseArray['paymentType'] : '';
        $brand                = isset($responseArray['financialInstitution']) ? $responseArray['financialInstitution'] : '';
        $message              = '';
        $everythingOk         = false;

        if (strcmp($paymentState,'CANCEL') == 0)
        {
            $message = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CANCEL_TEXT;
            $this->debug_log(MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CANCEL_TEXT);
        }
        else if (strcmp($paymentState,'FAILURE') == 0)
        {
            // use the error message given from wirecard system
            $message = isset($responseArray['message']) ? $responseArray['message'] : 'No Error given by Wirecard Checkout Page.';
            $this->debug_log('Paymentstate Failure: ' .$message);
        }
        else if (strcmp($paymentState,'SUCCESS') == 0 || strcmp($paymentState,'PENDING') == 0)
        {
            $everythingOk = $this->verifyFingerprint($responseArray);
            if ($everythingOk === false)
            {
                $paymentState = 'FAILURE';
                $message = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_FINGERPRINT_TEXT;
            }
        }

        if ($everythingOk)
        {
            if (strcmp($paymentState,'PENDING') == 0)
            {
                $message = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PENDING_TEXT;
                $order->info['order_status'] = $this->order_status_pending;
                $this->debug_log(MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PENDING_TEXT);
            } else {
                $order->info['order_status'] = $this->order_status;
            }

            $this->debug_log('fingerprints match. orderstatus set to: ' . $order->info['order_status']);
        }

        $gatewayRefNum = empty($responseArray['gatewayReferenceNumber']) ? '' : $responseArray['gatewayReferenceNumber'];

     $aArrayToBeJSONized = $responseArray;
        unset($aArrayToBeJSONized['responseFingerprintOrder']);
        unset($aArrayToBeJSONized['responseFingerprint']);
        unset($aArrayToBeJSONized['trid']);
        unset($aArrayToBeJSONized['x']);
        unset($aArrayToBeJSONized['y']);

        $result = xtc_db_query("UPDATE " . MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TRANSACTION_TABLE . " SET " .
            "ORDERNUMBER=" . $orderNumber . ", " .
            "ORDERDESCRIPTION='" . $orderDesc . "', " .
            "STATE='" . $paymentState . "', " .
            "MESSAGE='" . $message . "', " .
            "GATEWAY_REF_NUM='" . $gatewayRefNum . "', " .
            "RESPONSEDATA='" . json_encode($aArrayToBeJSONized) . "', " .
            (xtc_not_null($paysys) ? "PAYSYS='" . $paysys . "', " : "") . // overwrite only if given in response
            "BRAND='" . $brand . "' " .
            "WHERE TRID='" . $this->transaction_id . "'");

        if($result)
        {
            $this->debug_log('Transaction details set.');
        }

        if (!$everythingOk)
        {
            $redirectUrl = xtc_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=wirecard_checkout_page&message=' . $message, 'SSL', true, false);
            xtc_redirect($redirectUrl);
        }
    }

    /**
     * at this point, we have an order
     * dont output any data here, because checkout_process is redirecting
     */
    function after_process()
    {
        global $insert_id;

        if($insert_id)
        {
            $this->debug_log('Orderstatus update successful');
            // Finally, insert order ID into the transaction table
            $result = xtc_db_query("UPDATE " . MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TRANSACTION_TABLE . " SET " .
                                   "ORDERID=" . $insert_id . " " .
                                   "WHERE TRID='" . $this->transaction_id . "'");
            if($result)
            {
                $this->debug_log('orderID set for transaction.');
            }
            else
            {

            }
        }
    }


    /**
     * Server-to-server request, no session available
     */
    public function processConfirm()
    {
        $confirmReturnMessage = $this->_wirecardCheckoutPageConfirmResponse();
        if(get_magic_quotes_gpc() || get_magic_quotes_runtime())
        {
            $this->debug_log('magic_quotes enabled. Stripping slashes.');
            foreach($_POST AS $key=>$value)
            {
                $responseArray[$key] = stripslashes($value);
            }
        }
        else
        {
            $responseArray = $_POST;
        }

        if(isset($responseArray['trid']) && trim($responseArray['trid']) != '')
        {
            $this->transaction_id = $responseArray['trid'];
        }
        else
        {
            $confirmReturnMessage = $this->_wirecardCheckoutPageConfirmResponse('TransactionID not set or empty.');
            die($confirmReturnMessage);
        }

        // lets check, if you have an order-id in our transaction table
        $sql = 'SELECT ORDERID FROM ' . MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TRANSACTION_TABLE .' WHERE TRID="'.$this->transaction_id.'" LIMIT 1;';
        $result = xtc_db_query($sql);
        $row = $result->fetch_assoc();
        if ($row === false || (int)$row['ORDERID'] === 0)
        {
            $this->debug_log("no order id for trid:" . $this->transaction_id);
            // nothing todo
            echo $confirmReturnMessage;
            return;
        }

        $orderId = (int)$row['ORDERID'];

        $orderDesc            = isset($responseArray['orderDesc']) ? $responseArray['orderDesc'] : '';
        // orderNumber is only given if paymentState=success
        $orderNumber          = isset($responseArray['orderNumber']) ? $responseArray['orderNumber'] : 0;
        $paymentState         = isset($responseArray['paymentState']) ? $responseArray['paymentState'] : 'FAILURE';
        $paysys               = isset($responseArray['paymentType']) ? $responseArray['paymentType'] : '';
        $brand                = isset($responseArray['financialInstitution']) ? $responseArray['financialInstitution'] : '';
        $message              = '';
        $everythingOk         = false;

        if (strcmp($paymentState,'CANCEL') == 0)
        {
            // use the default cancel message from the translations
            $message = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CANCEL_TEXT;
            $this->debug_log(MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CANCEL_TEXT);
        }
        else if (strcmp($paymentState,'FAILURE') == 0)
        {
            // use the error message given from wirecard system
            $message = isset($responseArray['message']) ? $responseArray['message'] : 'No Error given by Wirecard Checkout Page.';
            $this->debug_log('Paymentstate Failure: ' .$responseArray['message']);
        }
        else if (strcmp($paymentState,'SUCCESS') == 0 || strcmp($paymentState,'PENDING') == 0)
        {
            $everythingOk = $this->verifyFingerprint($responseArray, $confirmReturnMessage);
            if ($everythingOk === false)
            {
                $paymentState = 'FAILURE';
                $message = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_FINGERPRINT_TEXT;
            }
        }

        if ($everythingOk)
        {
            if (strcmp($paymentState,'PENDING') == 0)
            {
                $message = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PENDING_TEXT;
                $order_status = $this->order_status_pending;
                $this->debug_log(MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PENDING_TEXT);
            } else {
                $order_status = $this->order_status;
            }

            xtc_db_query("update ".TABLE_ORDERS." set orders_status = $order_status where orders_id = $orderId");

            $customer_notification = (SEND_EMAILS == 'true') ? '1' : '0';
            $sql_data_array = array ('orders_id' => $orderId, 'orders_status_id' => $order_status, 'date_added' => 'now()', 'customer_notified' => $customer_notification);
            xtc_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

            $this->debug_log('fingerprints match. orderstatus set to: ' . $order_status);
        }

        $gatewayRefNum = empty($responseArray['gatewayReferenceNumber']) ? '' : $responseArray['gatewayReferenceNumber'];

        $aArrayToBeJSONized = $responseArray;
        unset($aArrayToBeJSONized['responseFingerprintOrder']);
        unset($aArrayToBeJSONized['responseFingerprint']);
        unset($aArrayToBeJSONized['trid']);
        unset($aArrayToBeJSONized['x']);
        unset($aArrayToBeJSONized['y']);

        $result = xtc_db_query("UPDATE " . MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TRANSACTION_TABLE . " SET " .
            "ORDERNUMBER=" . $orderNumber . ", " .
            "ORDERDESCRIPTION='" . $orderDesc . "', " .
            "STATE='" . $paymentState . "', " .
            "MESSAGE='" . $message . "', " .
            "GATEWAY_REF_NUM='" . $gatewayRefNum . "', " .
            "RESPONSEDATA='" . json_encode($aArrayToBeJSONized) . "', " .
            (xtc_not_null($paysys) ? "PAYSYS='" . $paysys . "', " : "") . // overwrite only if given in response
            "BRAND='" . $brand . "' " .
            "WHERE TRID='" . $this->transaction_id . "'");

        if($result)
        {
            $this->debug_log('Transaction details set.');
        }
        else
        {
            $confirmReturnMessage = $this->_wirecardCheckoutPageConfirmResponse('Transactiontable update failed.');
        }

        $this->debug_log($confirmReturnMessage);
        echo $confirmReturnMessage;
    }

    function verifyFingerprint($responseArray, &$confirmReturnMessage = '')
    {
        $tempArray = [];
        $responseFingerprintOrder = $responseArray['responseFingerprintOrder'];
        $responseFingerprint = $responseArray['responseFingerprint'];

        $mandatoryFingerprintFields = 0;
        $secretUsed = false;

        $fieldsNeeded = 2;
        if (array_key_exists('orderNumber', $responseArray))
            $fieldsNeeded = 3;

        $keyOrder = explode(',',$responseFingerprintOrder);
        $this->debug_log('Generating responseFingerprintSeed');
        foreach($keyOrder AS $key)
        {
            // check if there are enough fields in the responsefingerprint
            if ((strcmp($key, 'paymentState') == 0 && xtc_not_null($responseArray[$key])) ||
                (strcmp($key, 'orderNumber') == 0 && xtc_not_null($responseArray[$key])) ||
                (strcmp($key, 'paymentType') == 0 && xtc_not_null($responseArray[$key])))
            {
                $mandatoryFingerprintFields++;
            }

            if (strcmp($key, 'secret') == 0)
            {
                $tempArray[(string)$key] = MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SECRET;
                $secretUsed = true;
            }
            else
            {
                $tempArray[(string)$key] = $responseArray[$key];
            }
        }

        $hash = hash_init('sha512', HASH_HMAC, MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SECRET);

        foreach ($tempArray as $key => $value) {
            hash_update($hash, $value);
        }

        $responseFingerprintSeed = hash_final($hash);

        $this->debug_log('Calculated Fingerprint: ' . $responseFingerprintSeed . '. Compare with returned Fingerprint.');

        if(!$secretUsed)
        {
            $confirmReturnMessage = $this->_wirecardCheckoutPageConfirmResponse('Secret not used.');
            return false;
        }
        else if($mandatoryFingerprintFields != $fieldsNeeded)
        {
            $confirmReturnMessage = $this->_wirecardCheckoutPageConfirmResponse('Mandatory fields not used.');
            return false;
        }
        else
        {
            if ((strcmp($responseFingerprintSeed,$responseFingerprint) != 0))
            {
                $confirmReturnMessage = $this->_wirecardCheckoutPageConfirmResponse('Fingerprint validation failed.');
                return false;
            }
        }

        return true;
    }

    function get_error()
    {
        // after redirecting the customer to the checkout_payment page with a payment_error, this
        // class is loaded without saved data. for this reason we have to give the message from the
        // before_process function via GET-parameters and can use them here
        $message = isset($_GET["message"]) ? $_GET["message"] : MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ERROR_TEXT;

        $error = array('title' => '', // not used in checkout_payment to display the error
                       'error' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ERROR_TITEL . ": " . $message);

        return $error;
    }

    function check()
    {
        if (!isset($this->_check))
        {
            $check_query = xtc_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_STATUS'");
            $this->_check = xtc_db_num_rows($check_query);
        }
        return $this->_check;
    }

    function install()
    {
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_STATUS', 'True', '6', '0', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CUSTOMERID', '', '6', '1', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SHOPID', '', '6', '2', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SECRET', '', '6', '3', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_USE_IFRAME', 'False', '6', '4', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SELECT', 'True', '6', '5', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_TEXT', 'Already activated payment modules (e.g. MasterCard, VISA)', '6', '6', now())");

        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARD', 'False', '6', '202', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MAESTRO', 'False', '6', '204', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EPS', 'False', '6', '206', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_IDEAL', 'False', '6', '208', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_WGP', 'False', '6', '210', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SUE', 'False', '6', '212', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PBX', 'False', '6', '214', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PSC', 'False', '6', '216', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_QUICK', 'False', '6', '218', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PAYPAL', 'False', '6', '220', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_ELV', 'False', '6', '222', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_C2P', 'False', '6', '224', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");

        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INVOICE', 'False', '6', '228', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARDMOTO', 'False', '6', '230', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_BMC', 'False', '6', '232', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EKONTO', 'False', '6', '234', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTALLMENT', 'False', '6', '236', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTANTBANK', 'False', '6', '238', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MONETA', 'False', '6', '240', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_P24', 'False', '6', '242', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_POLI', 'False', '6', '244', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MPASS', 'False', '6', '246', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLDIRECT', 'False', '6', '248', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLWALLET', 'False', '6', '250', 'xtc_cfg_select_option(array(\'False\', \'True\'), ', now())");

        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SERVICEURL', '', '6', '300', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_IMAGEURL', '', '6', '301', now())");
        
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MIN_AMOUNT', '100', '6', '310', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MAX_AMOUNT', '10000', '6', '311', now())");

        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MIN_AMOUNT', '100', '6', '320', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MAX_AMOUNT', '10000', '6', '321', now())");

        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SORT_ORDER', '0', '6', '400', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ZONE', '0', '6', '410', 'xtc_get_zone_class_title', 'xtc_cfg_pull_down_zone_classes(', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, use_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_ID', '0', '6', '420', 'xtc_cfg_pull_down_order_statuses(', 'xtc_get_order_status_name', now())");
        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, use_function, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_PENDING_ID', '0', '6', '430', 'xtc_cfg_pull_down_order_statuses(', 'xtc_get_order_status_name', now())");

        xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ALLOWED', '', '6', '0', now())");
        xtc_db_query("CREATE TABLE IF NOT EXISTS `".MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TRANSACTION_TABLE."` (
                        `TRID` varchar(255) NOT NULL default '',
                        `DATE` datetime NOT NULL default '0000-00-00 00:00:00',
                        `PAYSYS` varchar(50) NOT NULL default '',
                        `BRAND` varchar(100) NOT NULL default '',
                        `ORDERNUMBER` int(11) unsigned NOT NULL default '0',
                        `ORDERDESCRIPTION` varchar(255) NOT NULL default '',
                        `STATE` varchar(20) NOT NULL default '',
                        `MESSAGE` varchar(255) NOT NULL default '',
                        `ORDERID` int(11) unsigned NOT NULL default '0',
                        `GATEWAY_REF_NUM` varchar(255) NULL default '',
                        PRIMARY KEY  (`TRID`)
                        )");
    xtc_db_query("ALTER TABLE `" . MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TRANSACTION_TABLE. "` ADD `RESPONSEDATA` TEXT NULL DEFAULT NULL");
    }

    function remove()
    {
      $removeTXTable = isset($_GET['removeTXTable']) ? $_GET['removeTXTable'] : 'false';
      if($removeTXTable == 'true')
      {
          xtc_db_query("DROP TABLE ".MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TRANSACTION_TABLE);
      }
      else
      {
          xtc_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
          ?>
          <html>
          <head>
          <script language="JavaScript" type="text/JavaScript">
              if(confirm("Do you want to remove the Wirecard Checkout Page transactions-table from your system?") == true)
              {
                  window.location.href = "<?php echo xtc_href_link(FILENAME_MODULES, 'set=' . $_GET['set'] . '&module=wirecard_checkout_page&action=remove&removeTXTable=true'); ?>";
              }
              else
              {
                  window.location.href = "<?php echo xtc_href_link(FILENAME_MODULES, 'set=' . $_GET['set'] . '&module=wirecard_checkout_page'); ?>";
              }
          </script>
          </head>
          <body>

          </body>
          </html>
          <?php
          die();
      }
    }

    function keys()
    {
        return array('MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_STATUS',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_CUSTOMERID',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SHOPID',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SECRET',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_USE_IFRAME',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SELECT',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_TEXT',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARD',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MAESTRO',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EPS',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PBX',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PSC',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_QUICK',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_ELV',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_PAYPAL',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_IDEAL',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SUE',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_C2P',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_WGP',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INVOICE',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_CCARDMOTO',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_BMC',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_EKONTO',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTALLMENT',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_INSTANTBANK',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MONETA',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_P24',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_POLI',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_MPASS',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLDIRECT',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PAYSYS_SKRILLWALLET',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MIN_AMOUNT',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INVOICE_MAX_AMOUNT',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MIN_AMOUNT',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_INSTALLMENT_MAX_AMOUNT',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SERVICEURL',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_IMAGEURL',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_SORT_ORDER',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_ID',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ORDER_STATUS_PENDING_ID',
                    'MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_ZONE',
        );
    }

    function generate_trid()
    {
        do
        {
          $trid = xtc_create_random_value(16);
          $result = xtc_db_query("SELECT TRID FROM " . MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_TRANSACTION_TABLE . " WHERE TRID = '" . $trid . "'");
        }
        while (xtc_db_num_rows($result));

        return $trid;
    }

    function _getZoneCodeByName($zoneName)
    {
        $sql = 'SELECT zone_code FROM ' . TABLE_ZONES . ' WHERE zone_name=\'' .$zoneName .'\' LIMIT 1;';
        $result = xtc_db_query($sql);
        $resultRow = mysql_fetch_row($result);
        return $resultRow[0];
    }

    function _wirecardCheckoutPageConfirmResponse($message = null)
    {
        if($message != null)
        {
            $this->debug_log($message);
            $value = 'result="NOK" message="' . $message . '" ';
        }
        else
        {
            $value = 'result="OK"';
        }
        return '<!--<QPAY-CONFIRMATION-RESPONSE ' . $value . ' />-->';
    }

    function admin_order($oID)
    {
        return false;
    }
}
?>
