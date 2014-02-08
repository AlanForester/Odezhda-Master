<?php

use Clio\Console;

/**
 * A command to export the last retail orders to the new wholesale order.
 *
 * @package YiiBoilerplate\Console
 */
class OrderCommand extends CConsoleCommand
{

    /**
     * @var int Default customer id to assign to the new wholesale order.
     */
    private $wholesaleOrderCustomerId = 22713;

    /**
     * @var CActiveRecord Orders model.
     */
    private $ordersModel;

    /**
     * @var CActiveRecord Retail orders model.
     */
    private $retailOrdersModel;

    /**
     * What to do before running any action.
     *
     * We are just setting up the defaults here.
     */
    public function init()
    {
        $this->retailOrdersModel = RetailOrdersLayer::model();
    }

    /**
     * What to show to user when he run `yiic help order`
     *
     * @see CConsoleCommand.getHelp
     * @return string Short description of what this command does.
     */
    public function getHelp()
    {
        return <<<EOD
USAGE
	yiic order compose

DESCRIPTION
	Creates new wholesale order from the last retail orders.

EOD;

    }

    /**
     * Default action.
     *
     * Will be called either by `yiic order index` or just by `yiic order`.
     */
    public function actionIndex()
    {
        Console::output(
            $this->note('Unassigned retail order(s) found: ' . $this->countRetailOrders() . '.')
        );
    }

    private function countRetailOrders()
    {
        return $this->retailOrdersModel->count('orders_id IS NULL');
    }

    private function note($msg)
    {
        return "%B{$msg}%n";
    }

    private function value($msg)
    {
        return "`%C%_{$msg}%n`";
    }

    /**
     * Action to create new wholesale order from the last retail orders.
     */
    public function actionCompose()
    {
        if($this->countRetailOrders()) {
            $this->ordersModel = new OrdersLayer();
            $this->ordersModel->setAttributes(
                [
                    'ur_or_fiz' => 'f',
                    'customers_id' => $this->wholesaleOrderCustomerId,
                    'customers_groups_id' => 1,
                    'customers_name' => 'Розничные заказы',
                    'customers_company' => '',
                    'customers_street_address' => '',
                    'customers_suburb' => '',
                    'customers_city' => '',
                    'customers_postcode' => '',
                    'customers_state' => '',
                    'customers_country' => '',
                    'customers_telephone' => '',
                    'customers_email_address' => '',
                    /*'customers_address_format_id' => '0',
                    'delivery_adress_id' => null,*/
                    'delivery_name' => '',
                    'delivery_lastname' => '',
                    'delivery_otchestvo' => '',
                    'delivery_pasport_seria' => '',
                    'delivery_pasport_nomer' => '',
                    'delivery_pasport_kem_vidan' => '',
                    'delivery_pasport_kogda_vidan' => '0000-00-00',
                    'delivery_company' => '',
                    'delivery_street_address' => '',
                    'delivery_suburb' => '',
                    'delivery_city' => '',
                    'delivery_postcode' => '',
                    'delivery_state' => '',
                    'delivery_country' => '',
                    //'delivery_address_format_id' => '0',
                    'billing_name' => '',
                    'billing_company' => '',
                    'billing_street_address' => '',
                    'billing_suburb' => '',
                    'billing_city' => '',
                    'billing_postcode' => '',
                    'billing_state' => '',
                    'billing_country' => '',
                    //'billing_address_format_id' => '0',
                    'payment_method' => '',
                    'payment_info' => '',
                    /*'cc_type' => '',
                    'cc_owner' => '',
                    'cc_number' => '',
                    'cc_expires' => '',
                    'last_modified' => new CDbExpression('NOW()'),
                    'date_purchased' => new CDbExpression('NOW()'),
                    'date_akt' => '0000-00-00',
                    'buh_orders_id' => '1',
                    'nomer_akt' => '0',
                    'orders_status' => '0',
                    'orders_date_finished' => new CDbExpression('NOW()'),*/
                    'currency' => 'RUR',
                    'currency_value' => '1.000000',
                    'customers_fax' => '',
                    /*'customers_referer_url' => '',
                    'shipping_module' => '',
                    'referer' => '',
                    'print_torg' => 'b',
                    'default_provider' => '0',
                    'seller_id' => '0',
                    'orders_discont' => '0',
                    'orders_discont_comment' => '',*/
                ],
                false
            );
            $success = $this->ordersModel->save();
            $orderId = $this->ordersModel->getPrimaryKey();

            if($success) {
                $updatedCount = $this->retailOrdersModel->updateAll(
                    [
                        'orders_id'=>$orderId,
                        'retail_orders_statuses_id'=>3      //заказ "собран"
                    ],
                    'orders_id IS NULL'
                );

                Console::output(
                    $this->note(
                        ($updatedCount > 0 ? $updatedCount : 'No')
                            . ' retail order(s) was assigned to the new wholesale order (ID '.$orderId.').'
                    )
                );

            } else
                Console::output(
                    $this->note('New wholesale order was not created.')
                );

        } else
            Console::output(
                $this->note('No unassigned retail order(s) found.')
            );

    }
}
