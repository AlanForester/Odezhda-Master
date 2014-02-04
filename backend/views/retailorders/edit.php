<?php

$this->pageTitle = 'Розничные заказы: ' . ($item->id ? 'редактирование заказа ' . $item->id . ' (' . $item->customers_name . ')' : 'новый розничный заказ');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/retailorders/index")
];
?>
    <div class="span6">
        <?php
        /**
         * @var TbActiveForm $form
         * @var RetailOrdersController $this
         */
        $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            [
                'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                //'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => [
                    'validateOnSubmit' => true,
                ]
            ]

        );?>
        <fieldset>
            <legend>Розничный заказ</legend>
            <?php
            echo $form->hiddenField($item, 'id', []);
            echo $form->dropDownListControlGroup($item, 'retail_orders_statuses_id', $statuses, []);
            //echo $form->dropDownListControlGroup($item, 'delivery_points_id', $deliveryPoints, []);
            echo $form->dateFieldControlGroup($item, 'date_purchased', []);
            //echo $form->dropDownListControlGroup($item, 'default_provider', $defaultProviders, []);
            echo $form->numberFieldControlGroup($item, 'booker_orders_id', []);
            echo $form->dateFieldControlGroup($item, 'act_date', []);
            echo $form->numberFieldControlGroup($item, 'act_number', []);
            //echo $form->dropDownListControlGroup($item, 'seller_id', $sellers, []);
            //echo $form->dropDownListControlGroup($item, 'payment_method', $paymentMethods, []);
            //echo $form->dropDownListControlGroup($item, 'currency', $currencies, []);
            echo $form->numberFieldControlGroup($item, 'currency_value', []);
            ?>

        </fieldset>
        <input type="hidden" name="form_action" value="save">
        <?php $this->endWidget(); ?>
    </div>

<?php
if (!empty($item->id)) {
    ?>
    <div class="span6">
        <fieldset>
            <legend>Дополнительная информация</legend>
            <?php
            /*$this->widget(
                'yiiwheels.widgets.detail.WhDetailView',
                [
                    'data' => $item,
                    'attributes' => [
                        ['name' => 'id'],
                        ['name' => 'created'],
                    ],
                ]
            );*/
            ?>
        </fieldset>
    </div>
<?php
}
