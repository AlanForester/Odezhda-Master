<?php

$this->pageTitle = 'Розничные заказы: ' . ($item->id ? 'редактирование заказа номер ' . $item->id . ' от ' . $item->date_purchased : 'новый розничный заказ');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/retailorders/index")
];

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

);
?>
<div class="span12">
    <div class="span6">
        <?php
?>
        <fieldset>
            <legend>Основные параметры</legend>
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
    </div>

    <div class="span6">
        <fieldset>
            <legend>Покупатель</legend>

        </fieldset>
    </div>
</div>
<br><br>
<div>
    <div class="span6">
        <fieldset>
            <legend>Адрес оплаты</legend>

        </fieldset>
    </div>
    <div class="span6">
        <legend>Адрес доставки</legend>

        </fieldset>
    </div>
</div>
<input type="hidden" name="form_action" value="save">

<?php $this->endWidget(); ?>

<?php
if (!empty($item->id)) {
    ?>

<?php
}
