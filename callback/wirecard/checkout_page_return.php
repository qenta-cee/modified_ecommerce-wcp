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

    chdir('../../');
    require_once('includes/external/wirecard/wirecard_checkout_page.php');
    require_once('includes/application_top.php');

    $redirectUrl = xtc_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true, false);

    $formFields = '';
    foreach($_POST AS $param => $value)
    {
         $formFields .= '<input type="hidden" name="' . htmlentities($param, ENT_COMPAT, 'UTF-8') . '" value="' . htmlentities($value, ENT_COMPAT, 'UTF-8') . '" />';
    }

    $redirectText = $_SESSION['wirecard_checkout_page']['paypage_redirecttext'];
?>
<form action="<?php echo $redirectUrl; ?>" method="post" target="_parent" name="wirecardCheckoutPageReturn">
    <?php echo $redirectText; ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="right">
                <?php
                echo $formFields;
                ?>
                <input type="image" src="<?php echo xtc_parse_input_field_data('../../templates/'.CURRENT_TEMPLATE.'/buttons/' . $_SESSION['language'] . '/button_continue.gif', array('"' => '&quot;')) ?>" alt="<?php echo IMAGE_BUTTON_CONTINUE; ?>">
            </td>
        </tr>
    </table>
</form>

<script language="JavaScript" type="text/JavaScript">
    document.wirecardCheckoutPageReturn.submit();
</script>

