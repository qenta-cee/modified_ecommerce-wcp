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

/**
 * Transaction management
 *
 * Class WirecardCheckoutPageTransaction
 */
class WirecardCheckoutPageTransaction
{

    /**
     * @param $orders_id
     * @param $amount
     * @param $currency
     * @param $paymentname
     * @param $paymentmethod
     *
     * @return int
     */
    public function create($orders_id, $amount, $currency, $paymentname, $paymentmethod)
    {
        $values = sprintf("(0, %d, '%s', '%s', 'CREATED', %s, '%s', NOW())",
            $orders_id,
            xtc_db_input($paymentname),
            xtc_db_input($paymentmethod),
            (float)$amount,
            xtc_db_input($currency));

        $query = 'INSERT INTO ' . TABLE_PAYMENT_WCP . ' (id, orders_id, paymentname, paymentmethod, paymentstate, amount, currency, created) VALUES ' . $values;
        xtc_db_query($query);
        return xtc_db_insert_id();
    }

    /**
     * @param $txId
     * @param array $data
     *
     * @return int
     */
    public function update($txId, $data)
    {
        $values = '';

        foreach ($data as $f => $v) {
            if (strlen($values)) {
                $values .= ',';
            }

            if ($v == null) {
                $values .= sprintf("`%s`=NULL", $f);
            } else {
                $values .= sprintf("`%s`='%s'", $f, xtc_db_input($v));
            }
        }

        $query = 'UPDATE ' . TABLE_PAYMENT_WCP . ' SET ' . $values . ' WHERE id=' . (int)$txId;

        xtc_db_query($query);

        return xtc_db_affected_rows();
    }

    /**
     * get transaction from database
     * @param $txId
     *
     * @return array|null
     */
    public function get($txId)
    {
        $result = xtc_db_query(sprintf('SELECT * FROM %s WHERE id=%d', TABLE_PAYMENT_WCP, (int)$txId));
        $row = xtc_db_fetch_array($result);
        if ($row === false) {
            return null;
        }

        return $row;
    }

    /**
     * get transaction from database
     * @param int $orders_id
     *
     * @return array|null
     */
    public function getByOrderId($orders_id)
    {
        $result = xtc_db_query(sprintf('SELECT * FROM %s WHERE orders_id=%d', TABLE_PAYMENT_WCP, (int)$orders_id));
        $row = xtc_db_fetch_array($result);
        if ($row === false) {
            return null;
        }

        return $row;
    }


    /**
     * return list of transactions
     *
     * @param $count
     * @param $offset
     *
     * @return array
     */
    public function getList($count, $offset)
    {
        $transactions = array();
        $query = xtc_db_query("SELECT * from " . TABLE_PAYMENT_WCP . " ORDER BY id DESC LIMIT $offset, $count");
        while ($tx = xtc_db_fetch_array($query)) {
            $transactions[] = $tx;
        };

        return $transactions;
    }
}
