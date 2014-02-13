<?php

$this->pageTitle = 'Розничные заказы: ' . ($item->id ? 'редактирование заказа номер ' . $item->id : 'новый заказ');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/retail_orders/index")
];

/*if($item->id) {
    $this->widget(
        'backend.widgets.SubMenu',
        [
            'id' => 'submenu',
            'submenu' => BackendSubMenu::retailOrder($item->id),
        ]
    );
}*/
?>
<div class="span12">
    <?php
    /**
     * @var TbActiveForm $form
     * @var RetailOrdersController $this
     */
    $form = $this->beginWidget(
        'backend.widgets.ActiveForm',
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
        <div class="span7">
            <fieldset>
                <legend>Основные параметры заказа</legend>
                <?php
                echo $form->hiddenField($item, 'id', []);
                echo $form->hiddenField($item, 'customers_id', []);
                echo $form->dropDownListControlGroup($item, 'retail_orders_statuses_id', $statuses, []);
                //echo $form->dropDownListControlGroup($item, 'delivery_points_id', $deliveryPoints, []);
                //echo $form->dateFieldControlGroup($item, 'date_purchased', ['value' => $item->date_purchased ? : date("Y-m-d H:i:s")]);
                //echo $form->dropDownListControlGroup($item, 'default_provider', $defaultProviders, []);
                echo $form->numberFieldControlGroup($item, 'booker_orders_id', []);
                echo $form->datePickerControlGroup($item, 'act_date', [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'language' => 'ru'
                    ],
                ]);
                echo $form->numberFieldControlGroup($item, 'act_number', []);
                //echo $form->dropDownListControlGroup($item, 'seller_id', $sellers, []);
                echo $form->dropDownListControlGroup($item, 'payment_method', $paymentMethods, []);
                echo $form->dropDownListControlGroup($item, 'currency', $currencies, []);
                echo $form->numberFieldControlGroup($item, 'currency_value', ['value' => $item->currency_value ? : '1.000000']);




                //todo переделать: временная форма, аякс-обновление
                //поля, необходимые для отображения в index
                echo $form->hiddenField($item, 'customers_name', []);
                echo $form->hiddenField($item, 'customers_city', []);
                echo $form->hiddenField($item, 'customers_telephone', []);
                //поля not null
                echo $form->hiddenField($item, 'customers_street_address', ['value'=>'1']);
                echo $form->hiddenField($item, 'customers_postcode', ['value'=>'1']);
                echo $form->hiddenField($item, 'customers_state', ['value'=>'1']);
                echo $form->hiddenField($item, 'customers_country', ['value'=>'1']);
                echo $form->hiddenField($item, 'customers_email_address', ['value'=>'1']);
                echo $form->hiddenField($item, 'delivery_name', ['value'=>'1']);
                echo $form->hiddenField($item, 'delivery_middlename', ['value'=>'1']);
                echo $form->hiddenField($item, 'delivery_lastname', ['value'=>'1']);
                echo $form->hiddenField($item, 'delivery_street_address', ['value'=>'1']);
                echo $form->hiddenField($item, 'delivery_city', ['value'=>'1']);
                echo $form->hiddenField($item, 'delivery_postcode', ['value'=>'1']);
                echo $form->hiddenField($item, 'delivery_state', ['value'=>'1']);
                echo $form->hiddenField($item, 'delivery_country', ['value'=>'1']);
                echo $form->hiddenField($item, 'billing_name', ['value'=>'1']);
                echo $form->hiddenField($item, 'billing_street_address', ['value'=>'1']);
                echo $form->hiddenField($item, 'billing_city', ['value'=>'1']);
                echo $form->hiddenField($item, 'billing_postcode', ['value'=>'1']);
                echo $form->hiddenField($item, 'billing_state', ['value'=>'1']);
                echo $form->hiddenField($item, 'billing_country', ['value'=>'1']);


                ?>

            </fieldset>
        </div>

        <div class="span5">
            <fieldset >
                <legend>Покупатель</legend>
                <span id="customer_info">
                    <?php
                    if($item->customer && $item->customer->id) {
                        $this->widget(
                            'yiiwheels.widgets.detail.WhDetailView',
                            [
                                'data' => $item->customer,
                                'attributes' => [
                                    ['name' => 'id'],
                                    ['name' => 'firstname'],
                                    //['name' => 'middlename'],
                                    ['name' => 'lastname'],
                                    //['name' => 'gender'],
                                    //['name' => 'dob'],
                                    ['name' => 'email'],
                                    ['name' => 'phone'],
                                ],
                            ]
                        );
                        echo BackendPageButtons::edit("/customers/edit/".$item->customer->id);
                    }
                    ?>

                </span>
                <?=
                BackendPageButtons::selectCustomer();
                ?>

                <?php
                /*  //старая форма
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
                echo $form->emailFieldControlGroup($item, 'customers_email_address', []);*/
                ?>
            </fieldset>
        </div>
    </div>
    <!--
    <br><br>
    <div>
        <div class="span6">
            <legend>Адрес доставки</legend>
            <?php
            /*echo $form->textFieldControlGroup($item, 'delivery_name', []);
            echo $form->textFieldControlGroup($item, 'delivery_middlename', []);
            echo $form->textFieldControlGroup($item, 'delivery_lastname', []);
            //echo $form->textFieldControlGroup($item, 'delivery_passport_serie', []);
            //echo $form->textFieldControlGroup($item, 'delivery_passport_number', []);
            //echo $form->textFieldControlGroup($item, 'delivery_passport_issue_organization', []);
            //echo $form->textFieldControlGroup($item, 'delivery_passport_issue_date', []);
            //echo $form->textFieldControlGroup($item, 'delivery_company', []);
            echo $form->textFieldControlGroup($item, 'delivery_street_address', []);
            //echo $form->textFieldControlGroup($item, 'delivery_suburb', []);
            echo $form->textFieldControlGroup($item, 'delivery_city', []);
            echo $form->numberFieldControlGroup($item, 'delivery_postcode', []);
            //echo $form->dropDownListControlGroup($item, 'delivery_state_id', $countryStates, []);
            echo $form->textFieldControlGroup($item, 'delivery_state', []);
            //echo $form->dropDownListControlGroup($item, 'delivery_country_id', $countries, []);
            echo $form->textFieldControlGroup($item, 'delivery_country', []);*/
            ?>
            </fieldset>
        </div>
        <div class="span6">
            <fieldset>
                <legend>Адрес оплаты</legend>
                <?php
                /*echo $form->textFieldControlGroup($item, 'billing_name', []);
                //echo $form->textFieldControlGroup($item, 'billing_company', []);
                echo $form->textFieldControlGroup($item, 'billing_street_address', []);
                //echo $form->textFieldControlGroup($item, 'billing_suburb', []);
                echo $form->textFieldControlGroup($item, 'billing_city', []);
                echo $form->numberFieldControlGroup($item, 'billing_postcode', []);
                //echo $form->dropDownListControlGroup($item, 'billing_state_id', $countryStates, []);
                echo $form->textFieldControlGroup($item, 'billing_state', []);
                //echo $form->dropDownListControlGroup($item, 'billing_country_id', $countries, []);
                echo $form->textFieldControlGroup($item, 'billing_country', []);*/
                ?>
            </fieldset>
        </div>
    </div>
    -->
    <div class="row-fluid">
        <div class="span12" id="products_grid">

        </div>
    </div>
    <br><br>
    <input type="hidden" name="form_action" value="save">
    <?php $this->endWidget(); ?>
</div>