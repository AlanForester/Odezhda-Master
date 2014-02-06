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
        $this->retailOrdersModel = new RetailOrdersLayer();
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
        $retailOrdersCount = $this->retailOrdersModel->count('orders_id IS NULL');
        Console::output(
            $this->note('Unassigned retail orders found: ' . $retailOrdersCount . '.')
        );
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
        $this->ordersModel = new OrdersLayer();
        $this->ordersModel->setAttributes(
            [

            ],
            false
        );
        $success = $this->ordersModel->save();
        $orderId = $this->ordersModel->id;

        if($success) {
            $updatedCount = $this->retailOrdersModel->updateAll(
                [
                    'orders_id'=>$orderId
                ],
                'orders_id IS NULL'
            );

            Console::output(
                $this->note(
                    $updatedCount > 0 ? : 'No'
                        . ' retail orders was assigned to the new wholesale order (ID '.$orderId.').'
                )
            );

        } else
            Console::output(
                $this->note('New wholesale order was not created.')
            );

    }
}
