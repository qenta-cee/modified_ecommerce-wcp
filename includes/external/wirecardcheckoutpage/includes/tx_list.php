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

$list = $wcpTransaction->getList($page_max_display_results,
    ((isset($_GET['page']) && $_GET['page'] > 0) ? ($_GET['page'] * $page_max_display_results) : 0));
if (count($list) > 0) {
    ?>
    <table class="tableBoxCenter collapse">
        <tr class="dataTableHeadingRow">
            <th class="dataTableHeadingContent"><?php echo $wcpClass->getText('TABLE_HEADING_ORDER'); ?></th>
            <th class="dataTableHeadingContent"><?php echo $wcpClass->getText('TABLE_HEADING_MODULE'); ?></th>
            <th class="dataTableHeadingContent"><?php echo $wcpClass->getText('TABLE_HEADING_PAYMENTMETHOD'); ?></th>
            <th class="dataTableHeadingContent"><?php echo $wcpClass->getText('TABLE_HEADING_PAYMENTSTATE'); ?></th>
            <th class="dataTableHeadingContent"><?php echo $wcpClass->getText('TABLE_HEADING_ORDERNUMBER'); ?></th>
            <th class="dataTableHeadingContent"><?php echo $wcpClass->getText('TABLE_HEADING_GATEWAYREFERENCE'); ?></th>
            <th class="dataTableHeadingContent"><?php echo $wcpClass->getText('TABLE_HEADING_AMOUNT'); ?></th>
            <th class="dataTableHeadingContent"><?php echo $wcpClass->getText('TABLE_HEADING_CURRENCY'); ?></th>
            <th class="dataTableHeadingContent"><?php echo $wcpClass->getText('TABLE_HEADING_STATUS'); ?></th>
        </tr>
        <?php
        foreach ($list as $tx) {
            ?>
            <tr class="dataTableRow">
                <td class="dataTableContent txta-r"><?php echo(($tx['orders_id'] != '') ? '<a href="' . xtc_href_link(FILENAME_ORDERS,
                            'action=edit&oID=' . $tx['orders_id']) . '"><b>' . $tx['orders_id'] . '</b></a>' : 'n/a'); ?></td>
                <td class="dataTableContent"><?php echo $tx['paymentname']; ?></td>
                <td class="dataTableContent"><?php echo $tx['paymentmethod']; ?></td>
                <td class="dataTableContent"><?php echo $tx['paymentstate']; ?></td>
                <td class="dataTableContent txta-r"><?php echo $tx['ordernumber']; ?></td>
                <td class="dataTableContent"><?php echo $tx['gatewayreference']; ?></td>
                <td class="dataTableContent txta-r"><?php echo $tx['amount']; ?></td>
                <td class="dataTableContent"><?php echo $tx['currency']; ?></td>
                <td class="dataTableContent txta-c"><?php echo $tx['status']; ?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="10" style="border:none;">
                <?php
                if (isset($_GET['page']) && $_GET['page'] > 0) {
                    echo '<a class="button flt-l" href="' . xtc_href_link(basename($PHP_SELF),
                            'page=' . ($_GET['page'] - 1)) . '">&laquo;</a>';
                }
                if (!isset($_GET['page']) || count($list) == $page_max_display_results) {
                    echo '<a class="button flt-r" href="' . xtc_href_link(basename($PHP_SELF),
                            'page=' . ((isset($_GET['page'])) ? ($_GET['page'] + 1) : 1)) . '">&raquo;</a>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="10" style="border:none;">
                <?php echo draw_input_per_page($PHP_SELF, $cfg_max_display_results_key, $page_max_display_results); ?>
            </td>
        </tr>
    </table>
    <?php
} else {
    echo '<div class="info_message">' . $wcpClass->getText('TRANSACTIONS_INFO') . '</div>';
}