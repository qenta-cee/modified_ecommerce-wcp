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

require('includes/application_top.php');

// include needed classes
require_once(DIR_FS_EXTERNAL . 'wirecardcheckoutpage/Page.php');
require_once(DIR_FS_EXTERNAL . 'wirecardcheckoutpage/Transaction.php');
$wcpClass = new WirecardCheckoutPage();
$wcpTransaction = new WirecardCheckoutPageTransaction();

//display per page
$cfg_max_display_results_key = 'MAX_DISPLAY_WCP_PAYMENTS_RESULTS';
$page_max_display_results = xtc_cfg_save_max_display_results($cfg_max_display_results_key);
$page_max_display_results = (($page_max_display_results > 20) ? '20' : $page_max_display_results);

$action = $_GET['action'];
$txId = (int)$_GET['txId'];

$edit = false;
$transaction = null;
if (in_array($action, array('edit', 'payment', 'credit')) && $txId > 0) {
    $transaction = $wcpTransaction->get($txId);
    if ($transaction !== null) {
        $edit = true;
    }
}

require(DIR_WS_INCLUDES . 'head.php');
?>
    </head>
    <body>
    <!-- header //-->
    <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
    <!-- header_eof //-->

    <!-- body //-->
    <table class="tableBody">
        <tr>
            <?php //left_navigation
            if (USE_ADMIN_TOP_MENU == 'false') {
                echo '<td class="columnLeft2">' . PHP_EOL;
                echo '<!-- left_navigation //-->' . PHP_EOL;
                require_once(DIR_WS_INCLUDES . 'column_left.php');
                echo '<!-- left_navigation eof //-->' . PHP_EOL;
                echo '</td>' . PHP_EOL;
            }
            ?>
            <!-- body_text //-->
            <td class="boxCenter">
                <div
                    class="pageHeadingImage"><?php echo xtc_image(DIR_WS_ICONS . 'heading/icon_configuration.png'); ?></div>
                <div class="flt-l">
                    <div class="pageHeading pdg2"><?php echo $wcpClass->getText('BACKEND_HEADING_TITLE') ?></div>
                </div>
                <?php
                include_once(DIR_FS_EXTERNAL . 'wirecardcheckoutpage/admin_menu.php');
                ?>
                <div class="clear div_box mrg5" style="margin-top:-1px;">
                    <?php
                    include(DIR_FS_EXTERNAL . 'wirecardcheckoutpage/includes/tx_list.php');
                    ?>
                </div>
            </td>
            <!-- body_text_eof //-->
        </tr>
    </table>
    <!-- body_eof //-->
    <!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <!-- footer_eof //-->
    </body>
    </html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>