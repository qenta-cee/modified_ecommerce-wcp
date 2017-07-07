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

defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

?>
<div class="clear configPartner cf" style="border-bottom: none;">
    <?php
    if (isset($admin_access['wirecardcheckoutpage_tx']) && $admin_access['wirecardcheckoutpage_tx'] == '1') {
        echo '<a class="configtab' . (((basename($PHP_SELF) == 'wirecardcheckoutpage_tx.php') ? ' activ' : '') ? ' activ' : '') . '" href="' . xtc_href_link('wirecardcheckoutpage_tx.php',
                '', 'NONSSL') . '">' . TEXT_WIRECARDCHECKOUTPAGE_TAB_TX . '</a>';
    }
    if (isset($admin_access['wirecardcheckoutpage_config']) && $admin_access['wirecardcheckoutpage_config'] == '1') {
        echo '<a class="configtab' . ((basename($PHP_SELF) == 'wirecardcheckoutpage_config.php') ? ' activ' : '') . '" href="' . xtc_href_link('wirecardcheckoutpage_config.php',
                '', 'NONSSL') . '">' . TEXT_WIRECARDCHECKOUTPAGE_TAB_CONFIG . '</a>';
    }
    if (isset($admin_access['wirecardcheckoutpage_support']) && $admin_access['wirecardcheckoutpage_support'] == '1') {
        echo '<a class="configtab' . (((basename($PHP_SELF) == 'wirecardcheckoutpage_support.php') ? ' activ' : '') ? ' activ' : '') . '" href="' . xtc_href_link('wirecardcheckoutpage_support.php',
                '', 'NONSSL') . '">' . TEXT_WIRECARDCHECKOUTPAGE_TAB_SUPPORT . '</a>';
    }
    ?>
</div>