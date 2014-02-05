<?php

$this->pageTitle = 'Товары: ' . ($item->id ? 'редактирование товара номер ' . $item->id . ' (' . $item->products_model . ')' : 'новый товар в заказе');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/retail_orders_products/order/".$orderId)
];

$this->widget(
    'backend.widgets.SubMenu',
    [
        'submenu' => BackendSubMenu::retailOrder($item->id),
    ]
);
?>
    <div class="span10">
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

        );
        ?>
        <div class="span12">
            <div class="span6">
                <fieldset>
                    <legend>Основные параметры товара</legend>
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

                    echo $form->dropDownListControlGroup($item, 'payment_method', $paymentMethods, []);
                    echo $form->dropDownListControlGroup($item, 'currency', $currencies, []);
                    echo $form->numberFieldControlGroup($item, 'currency_value', []);
                    ?>

                </fieldset>
            </div>

            <div class="span6">
                <fieldset>
                    <legend>Дополнительная информация</legend>
                    <?php
                    echo $form->textFieldControlGroup($item, 'customers_name', []);
                    //echo $form->textFieldControlGroup($item, 'customers_company', []);
                    echo $form->textFieldControlGroup($item, 'customers_street_address', []);
                    //echo $form->textFieldControlGroup($item, 'customers_suburb', []);
                    echo $form->textFieldControlGroup($item, 'customers_city', []);
                    echo $form->numberFieldControlGroup($item, 'customers_postcode', []);
                    //echo $form->dropDownListControlGroup($item, 'customers_state_id', $countryStates, []);
                    echo $form->textFieldControlGroup($item, 'customers_state', []);
                    //echo $form->dropDownListControlGroup($item, 'customers_country_id', $countries, []);
                    echo $form->textFieldControlGroup($item, 'customers_country', []);
                    echo $form->textFieldControlGroup($item, 'customers_telephone', []);
                    echo $form->textFieldControlGroup($item, 'customers_email_address', []);
                    ?>
                </fieldset>
            </div>
        </div>
        <input type="hidden" name="form_action" value="save">
        <?php $this->endWidget(); ?>
    </div>