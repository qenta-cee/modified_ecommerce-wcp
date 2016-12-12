<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Wirecard Central Eastern
 * Europe GmbH
 * (abbreviated to Wirecard CEE) and are explicitly not part of the Wirecard
 * CEE range of products and services.
 *
 * They have been tested and approved for full functionality in the standard
 * configuration
 * (status on delivery) of the corresponding shop system. They are under
 * General Public License Version 2 (GPLv2) and can be used, developed and
 * passed on to third parties under the same terms.
 *
 * However, Wirecard CEE does not provide any guarantee or accept any liability
 * for any errors occurring when used in an enhanced, customized shop system
 * configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and
 * requires a comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Wirecard CEE does not guarantee
 * their full functionality neither does Wirecard CEE assume liability for any
 * disadvantages related to the use of the plugins. Additionally, Wirecard CEE
 * does not guarantee the full functionality for customized shop systems or
 * installed plugins of other vendors of plugins within the same shop system.
 *
 * Customers are responsible for testing the plugin's functionality before
 * starting productive operation.
 *
 * By installing the plugin into the shop system the customer agrees to these
 * terms of use. Please do not use the plugin if you do not agree to these
 * terms of use!
 *
 * @author    WirecardCEE
 * @copyright WirecardCEE
 * @license   GPLv2
 */
chdir("../../");
include('includes/application_top.php');
require_once('lang/' . $_SESSION["language"] . '/modules/payment/wirecard_checkout_page.php');

$_SESSION['cart']->reset(true);
unset($_SESSION['sendto']);
unset($_SESSION['billto']);
unset($_SESSION['shipping']);
unset($_SESSION['payment']);
unset($_SESSION['comments']);

// create smarty elements
$smarty = new Smarty;
// include boxes
require(DIR_FS_CATALOG . 'templates/' . CURRENT_TEMPLATE . '/source/boxes.php');

// if the customer is not logged on, redirect them to the login page

if (!isset ($_SESSION['customer_id'])) {
    xtc_redirect(xtc_href_link(FILENAME_LOGIN, '', 'SSL'));
}

$orders_query = xtc_db_query(
    "SELECT orders_id,
                                     orders_status,
                                     payment_class
                                FROM " . TABLE_ORDERS . "
                               WHERE customers_id = '" . $_SESSION['customer_id'] . "'
                                 AND unix_timestamp(date_purchased) > (unix_timestamp(now()) - '" . SESSION_LIFE_CUSTOMERS . "')
                            ORDER BY orders_id DESC
                               LIMIT 1"
);

// if no order exists for customer redirect them to the shopping cart page
if (xtc_db_num_rows($orders_query) < 1) {
    xtc_redirect(xtc_href_link(FILENAME_SHOPPING_CART), 'NONSSL');
} else {
    $orders = xtc_db_fetch_array($orders_query);
    $last_order = $orders['orders_id'];
    $order_status = $orders['orders_status'];
    $payment_class = $orders['payment_class'];
}

// load the selected payment module
require_once(DIR_WS_CLASSES . 'payment.php');
$payment_modules = new payment($payment_class);

$smarty->assign(
    array(
        'heading_success' => MODULE_PAYMENT_WIRECARD_CHECKOUT_PAGE_PENDING_TITLE,
        'PAYMENT_INFO' => $payment_modules->success(),
        'FORM_ACTION' => xtc_draw_form(
                'order', xtc_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=update', 'SSL')
            ) . xtc_draw_hidden_field('account_type', $_SESSION['account_type']),
        'BUTTON_CONTINUE' => xtc_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE),
        'FORM_ACTION_PRINT' => xtc_draw_form(
                'print_order', xtc_href_link(FILENAME_PRINT_ORDER, 'oID=' . $last_order, 'SSL'), 'post',
                'target="popup" onsubmit="javascript:window.open(\'' . xtc_href_link(
                    FILENAME_PRINT_ORDER, 'oID=' . $last_order, 'SSL'
                ) . '\', \'popup\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no, ' . POPUP_PRINT_ORDER_SIZE . '\')"'
            ) . xtc_draw_hidden_field('customer_id', $_SESSION['customer_id']),
        'BUTTON_PRINT' => xtc_image_submit('print.gif', TEXT_PRINT),
        'FORM_ACTION_PRINT_LAYER' => xtc_draw_form(
                'print_order_layer', xtc_href_link(
                FILENAME_PRINT_ORDER, 'oID=' . $last_order, 'SSL', 'post', 'target="popup"'
            )
            ) . xtc_draw_hidden_field('customer_id', $_SESSION['customer_id']),
        'FORM_END' => '</form>'
    )
);

// GV Code
if (ACTIVATE_GIFT_SYSTEM == 'true') {
    $gv_query = xtc_db_query(
        "SELECT amount 
                              FROM " . TABLE_COUPON_GV_CUSTOMER . " 
                             WHERE customer_id='" . $_SESSION['customer_id'] . "'"
    );
    if ($gv_result = xtc_db_fetch_array($gv_query)) {
        if ($gv_result['amount'] > 0) {
            $smarty->assign('GV_SEND_LINK', xtc_href_link(FILENAME_GV_SEND));
        }
    }
}

$smarty->assign('language', $_SESSION['language']);

$breadcrumb->add(NAVBAR_TITLE_1_CHECKOUT_SUCCESS);
$breadcrumb->add(NAVBAR_TITLE_2_CHECKOUT_SUCCESS);

require(DIR_WS_INCLUDES . 'header.php');

// Downloads
if (DOWNLOAD_ENABLED == 'true') {
    include(DIR_WS_MODULES . 'downloads.php');
}

if (isset($_SESSION['NO_SHIPPING']) && $_SESSION['NO_SHIPPING'] === true) {
    $smarty->assign('NO_SHIPPING', $_SESSION['NO_SHIPPING']);
}

//delete Guests from Database
if ($_SESSION['account_type'] == '1') {
    if (DELETE_GUEST_ACCOUNT == 'true') {
        xtc_db_query("DELETE FROM " . TABLE_CUSTOMERS . " WHERE customers_id = '" . $_SESSION['customer_id'] . "'");
        xtc_db_query("DELETE FROM " . TABLE_ADDRESS_BOOK . " WHERE customers_id = '" . $_SESSION['customer_id'] . "'");
        xtc_db_query(
            "DELETE FROM " . TABLE_CUSTOMERS_INFO . " WHERE customers_info_id = '" . $_SESSION['customer_id'] . "'"
        );
        xtc_db_query("DELETE FROM " . TABLE_CUSTOMERS_IP . " WHERE customers_id = '" . $_SESSION['customer_id'] . "'");
    }
    xtc_session_destroy();

    unset ($_SESSION['customer_id']);
    unset ($_SESSION['customer_default_address_id']);
    unset ($_SESSION['customer_first_name']);
    unset ($_SESSION['customer_country_id']);
    unset ($_SESSION['customer_zone_id']);
    unset ($_SESSION['comments']);
    unset ($_SESSION['user_info']);
    unset ($_SESSION['customers_status']);
    unset ($_SESSION['selected_box']);
    unset ($_SESSION['navigation']);
    unset ($_SESSION['shipping']);
    unset ($_SESSION['payment']);
    unset ($_SESSION['ccard']);
    unset ($_SESSION['gv_id']);
    unset ($_SESSION['cc_id']);
    require(DIR_WS_INCLUDES . 'write_customers_status.php');
}

$main_content = $smarty->fetch(CURRENT_TEMPLATE . '/module/checkout_wirecard_pending_page.html');
$smarty->assign(
    array(
        'fullcontent' => true,
        'main_content' => $main_content
    )
);
$smarty->caching = 0;
if (!defined('RM')) {
    $smarty->load_filter('output', 'note');
}
$smarty->display(CURRENT_TEMPLATE . '/index.html');
include('includes/application_bottom.php');
?>
