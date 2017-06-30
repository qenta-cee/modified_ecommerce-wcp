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

require_once(DIR_FS_CATALOG . 'includes/modules/payment/wcp_ccard.php');

class wcp_ccardmoto extends wcp_ccard
{
    protected $_defaultSortOrder = 11;
    protected $_paymenttype = WirecardCEE_Stdlib_PaymentTypeAbstract::CCARD_MOTO;
    protected $_logoFilename = 'ccMoto.png';

    /**
     * @return bool
     */
    function _preCheck()
    {
        if (!parent::_preCheck()) {
            return false;
        }

        if (!isset($_SESSION['customers_status'])) {
            return false;
        }

        return $_SESSION['customers_status']['customers_status_id'] == $this->getConfigParam('USERGROUP');
    }

    /**
     * configuration array
     *
     * @return array
     */
    protected function _configuration()
    {
        $config = parent::_configuration();

        $config['USERGROUP'] = array(
            'configuration_value' => DEFAULT_CUSTOMERS_STATUS_ID_ADMIN,
            'use_function' => 'wcp_ccardmoto_cfg_get_groupname',
            'set_function' => "wcp_ccardmoto_cfg_pull_down_usergroups( "
        );

        return $config;
    }
}

/**
 * ccard moto option list for usergroups
 *
 * @param string $provider
 * @param string $key
 *
 * @return string
 */
function wcp_ccardmoto_cfg_pull_down_usergroups($provider, $key = '')
{
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $groups = array();

    $query = "SELECT customers_status_name AS text,
                    customers_status_id AS id
                 FROM " . TABLE_CUSTOMERS_STATUS .
        " WHERE language_id = " . $_SESSION['languages_id'] .
        " AND customers_status_id != " . DEFAULT_CUSTOMERS_STATUS_ID_GUEST;

    $result = xtc_db_query($query);
    while ($group = xtc_db_fetch_array($result)) {
        if ($group['id'] == DEFAULT_CUSTOMERS_STATUS_ID_GUEST) {
            continue;
        }
        $groups[] = $group;
    }

    return xtc_draw_pull_down_menu($name, $groups, $provider);
}


/**
 * @param mixed $group_id
 *
 * @return mixed
 */
function wcp_ccardmoto_cfg_get_groupname($group_id)
{
    $query = xtc_db_query("SELECT customers_status_name
                                  FROM " . TABLE_CUSTOMERS_STATUS . "
                                 WHERE customers_status_id = '" . (int)$group_id . "'" .
        " AND language_id = " . $_SESSION['languages_id']);
    if (!xtc_db_num_rows($query)) {
        return $group_id;
    } else {
        $group = xtc_db_fetch_array($query);

        return $group['customers_status_name'];
    }
}
