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
require_once(DIR_FS_INC . 'xtc_php_mail.inc.php');
// include needed classes
require_once(DIR_FS_EXTERNAL . 'wirecardcheckoutpage/Page.php');
$wcpAdmin = new WirecardCheckoutPage();

$errors = array();
$infos = array();
$fields = array('to', 'replyto', 'message');

$params = array();
foreach ($fields as $f) {
    $params[$f] = null;
}

if (isset($_POST['send']) && is_array($_POST['support'])) {
    try {

        foreach ($_POST['support'] as $f => $v) {
            if (!in_array($f, $fields)) {
                continue;
            }

            $params[$f] = rtrim($v);
        }

        if (!xtc_validate_email($params['replyto'])) {
            throw new \Exception('invalid e-mail address given');
        }

        if (!xtc_validate_email($params['to'])) {
            throw new \Exception('invalid e-mail address given');
        }

        $msg = str_replace("\n", "<br/>\n", $params['message']);
        $msg .= "<br/><br/>\n";
        $msg .= "Plugin version:<br/>\n";
        $msg .= base64_decode($wcpAdmin->getPluginVersion());
        $msg .= "<br/><br/>\n";

        $msg .= "Plugin configuration:<br/>\n";
        $msg .= $wcpAdmin->getConfigString();
        $msg .= "<br/><br/>\n";

        $msg .= "Installed modules:<br/>\n";
        $module_directory = DIR_WS_MODULES . 'payment/';
        $modules = explode(';', MODULE_PAYMENT_INSTALLED);
        foreach ($modules as $file) {
            $class = substr($file, 0, strrpos($file, '.'));
            $module_status = (defined('MODULE_PAYMENT_' . strtoupper($class) . '_STATUS') && strtolower(constant('MODULE_PAYMENT_' . strtoupper($class) . '_STATUS')) == 'true') ? true : false;
            $msg .= sprintf('%s:%s', $class, $module_status ? 'active' : 'disabled');
            $msg .= "<br/>\n";
        }
        $msg .= "<br/><br/>\n";
        $msg .= '[SIGNATUR]';
        xtc_php_mail(EMAIL_SUPPORT_ADDRESS, // from-email
            EMAIL_SUPPORT_NAME, // from-email-name
            $params['to'], // to-email
            '', // to-name
            '', // forward to
            $params['replyto'], // reply-email
            '', // reply-email-name
            '', // attachments
            '', // more attachments
            'Support request', // email-subject
            $msg, // body-html
            $msg // body-text
        );

        xtc_redirect(xtc_href_link(basename($PHP_SELF), 'success=1'));
    } catch (\Exception $e) {
        $errors[] = $e->getMessage();
    }
}

if (isset($_GET['success'])) {
    $infos[] = $wcpAdmin->getText('SUPPORT_SUCCESS');
}

$fieldNoteFmt = sprintf('<a href="https://guides.wirecard.at/doku.php%%s" target="_blank">%s</a>',
    $wcpAdmin->getText('MORE_INFORMATION'));

//$locale_code = array(
require(DIR_WS_INCLUDES . 'head.php');
?>
    <link rel="stylesheet" type="text/css" href="../includes/external/wirecardcheckoutpage/css/admin.css">
    </head>
    <body>

    <!-- header //-->
    <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
    <!-- header_eof //-->

    <!-- body //-->
    <?php
    echo xtc_draw_form('config', basename($PHP_SELF), xtc_get_all_get_params(array('action')) . 'action=send');
    ?>
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
                    <div
                        class="pageHeading pdg2"><?php echo $wcpAdmin->getText('SUPPORT_HEADING_TITLE'); ?>
                    </div>
                </div>
                <?php
                include_once(DIR_FS_EXTERNAL . 'wirecardcheckoutpage/admin_menu.php');
                ?>
                <div class="clear div_box mrg5" style="margin-top:-1px;">
                    <?php

                    if (count($errors)) {
                        printf('<div class="error_message">%s</div>', implode("<br/>", $errors));
                    }
                    if (count($infos)) {
                        printf('<div class="info_message">%s</div>', implode("<br/>", $infos));
                    }

                    ?>
                    <table class="clear tableConfig">
                        <tr>
                            <td class="dataTableConfig col-left"><?php echo $wcpAdmin->getText('SUPPORT_CHANNEL');
                                echo '<br/>' . TEXT_FIELD_REQUIRED; ?></td>
                            <td class="dataTableConfig col-middle wcp-col-middle">
                                <?php
                                echo xtc_draw_pull_down_menu("support[to]", array(
                                    array(
                                        'id' => 'support.at@wirecard.com',
                                        'text' => 'Support Team Wirecard CEE, Austria'
                                    ),
                                    array(
                                        'id' => 'support@wirecard.com',
                                        'text' => 'Support Team Wirecard AG, Germany'
                                    ),
                                    array(
                                        'id' => 'support.sg@wirecard.com',
                                        'text' => 'Support Team Wirecard Singapore'
                                    )
                                ), $params['to']);
                                ?>
                            </td>
                            <td class="dataTableConfig col-left"></td>
                        </tr>
                        <tr>
                            <td class="dataTableConfig col-left"><?php echo $wcpAdmin->getText('SUPPORT_REPLYTO');
                                echo '<br/>' . TEXT_FIELD_REQUIRED; ?></td>
                            <td class="dataTableConfig col-middle">
                                <?php
                                echo xtc_draw_input_field("support[replyto]", $params['replyto'],
                                    'style="width: 400px;" required="required"');
                                ?>
                            </td>
                            <td class="dataTableConfig col-left"></td>
                        </tr>

                        <tr>
                            <td class="dataTableConfig col-left"><?php echo $wcpAdmin->getText('SUPPORT_MESSAGE'); ?></td>
                            <td class="dataTableConfig col-middle">
                                <?php
                                echo xtc_draw_textarea_field("support[message]", 'soft', 80, 40, $params['message']);
                                ?>
                            </td>
                            <td class="dataTableConfig col-left"></td>
                        </tr>
                    </table>


                    <table class="clear tableConfig">
                        <tr>
                            <td class="txta-l" colspan="3" style="border:none;">
                                <input class="button btn_wide" type="submit" name="send"
                                       value="<?php echo $wcpAdmin->getText('SUPPORT_SEND'); ?>">
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <!-- body_text_eof //-->
        </tr>
    </table>
    </form>
    <!-- body_eof //-->
    <!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <!-- footer_eof //-->

    </body>
    </html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>