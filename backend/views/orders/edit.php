<?php

Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/retailorder.css');
Yii::app()->getClientScript()->registerScriptFile($this->assets_backend . '/retailorder.js');

$this->pageTitle = 'Оптовые заказы: ' . ($item->id ? 'редактирование заказа номер ' . $item->id : 'новый заказ');

$this->pageButton = [
    BackendPageButtons::save(),
    $item->id ? BackendPageButtons::apply() : '',
    BackendPageButtons::cancel("/orders/index")
];

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
          //  echo $form->dropDownListControlGroup($item, 'retail_orders_statuses_id', $statuses, []);
           // echo $form->dropDownListControlGroup($item, 'delivery_points_id', $deliveryPoints, []);
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
//            echo $form->dropDownListControlGroup($item, 'payment_method', $paymentMethods, []);
//            echo $form->dropDownListControlGroup($item, 'currency', $currencies, []);
            echo $form->numberFieldControlGroup($item, 'currency_value', ['value' => $item->currency_value ? : '1.000000']);




            //todo переделать: временная форма, таблица бд, аякс-обновление
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
                        echo BackendPageButtons::editCustomer("/customers/edit/".$item->customer->id, '?referrer[url]=retail_orders/edit&referrer[id]='.$item->id);
                    }
                    ?>

                </span>
            <?= BackendPageButtons::selectCustomer('/customers/bootbox/'.$item->id) ?>

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
    <fieldset>
        <legend>Товары в заказе: список</legend>
        <div class="container-fluid">
            <div class="row-fluid">
                <div style="padding-bottom: 16px" class="span12 pull-left button-block">
                    <?php
                    echo BackendPageButtons::addProduct($item->id)
                        . BackendPageButtons::removeProducts("/retail_orders_products/mass/", $item->id)
                        . BackendPageButtons::mass("/retail_orders_products/mass/".$item->id)
                    ?>
                </div>
            </div>
        </div>
        <div>
            <div class="span12">
                <?php
                //$modelName = Yii::app()->controller->action->id == 'edit' ? 'RetailOrdersProducts' : '';
                $this->widget(
                    'backend.widgets.CompactGrid',
                    [
                        'gridId' => 'ropgrid',

                        'selectableRows' => 2,

                        'pageSize' => $productsCriteria,

                        'dataProvider' => $productsGridDataProvider,

                        'gridColumns' => [
                            [
                                'class' => 'backend.widgets.ace.CheckBoxColumn',
                                'checkBoxHtmlOptions' => [
                                    'name' => 'product_ids[]'
                                ],
                            ],
                            [
                                'header' => 'Название',
                                'class' => 'backend.widgets.EditableColumn',
                                'type' => 'text',
                                //'modelName' => $modelName,
                                'name' => 'name',
                                'headerHtmlOptions' => [
                                ],
                                'htmlOptions' => [
                                ],
                                'editable' => [
                                    'placement' => 'right',
                                    'emptytext' => 'не задано',
                                    'url' => Yii::app()->createUrl("/retail_orders_products/update"),
                                ]
                            ],
                            [
                                'header' => 'Код модели',
                                'class' => 'backend.widgets.EditableColumn',
                                'type' => 'text',
                                //'modelName' => $modelName,
                                'name' => 'model',
                                'headerHtmlOptions' => [
                                ],
                                'htmlOptions' => [
                                ],
                                'editable' => [
                                    'placement' => 'right',
                                    'emptytext' => 'не задано',
                                    'url' => Yii::app()->createUrl("/retail_orders_products/update"),
                                ]
                            ],
                            [
                                'header' => 'Размер',
                                'class' => 'backend.widgets.EditableColumn',
                                'name' => 'params',
                                //'modelName' => $modelName,
                                'headerHtmlOptions' => [
                                ],
                                'htmlOptions' => [
                                ],
                                'editable' => [
                                    'type' => 'select',
                                    'placement' => 'right',
                                    'emptytext' => 'не задано',
                                    'url' => Yii::app()->createUrl("/retail_orders_products/update"),
                                    'source' => $productOptions,
                                ]
                            ],
                            [
                                'header' => 'Количество',
                                'class' => 'backend.widgets.EditableColumn',
                                'type' => 'text',
                                //'modelName' => $modelName,
                                'name' => 'quantity',
                                'headerHtmlOptions' => [
                                ],
                                'htmlOptions' => [
                                ],
                                'editable' => [
                                    'placement' => 'right',
                                    'emptytext' => 'не задано',
                                    'url' => Yii::app()->createUrl("/retail_orders_products/update"),
                                ]
                            ],
                            [
                                'header' => 'Цена (за единицу)',
                                'class' => 'backend.widgets.EditableColumn',
                                'type' => 'text',
                                //'modelName' => $modelName,
                                'name' => 'price',
                                'headerHtmlOptions' => [
                                ],
                                'htmlOptions' => [
                                ],
                                'editable' => [
                                    'placement' => 'right',
                                    'emptytext' => 'не задано',
                                    'url' => Yii::app()->createUrl("/retail_orders_products/update"),
                                ]
                            ],
                            /*[
                                'header' => 'ID',
                                'name' => 'id',
                                'headerHtmlOptions' => [
                                ],
                                'htmlOptions' => [
                                ],
                            ],*/

                            [
                                'header' => 'Действие',
                                'htmlOptions' => [
                                    'class' => 'action-buttons',
                                    'width' => '70px'
                                ],
                                'class' => 'bootstrap.widgets.TbButtonColumn',
                                'afterDelete' => 'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                                'deleteButtonOptions' => [
                                    'class' => 'red bigger-130',
                                    'title' => 'Удалить товар из заказа',
                                    /*'onClick' => 'js: (function(){
                                        removeRetailOrdersProduct(event);
                                    })()'*/
                                ],
                                'updateButtonOptions' => [
                                    'class' => 'green bigger-130',
                                    'title' => 'Изменить товар',
                                ],
                                'viewButtonOptions' => [
                                    'class' => 'bigger-130',
                                    'title' => 'Просмотр',
                                    'onClick' => 'js: (function(){
                                            bootbox.alert("Здесь должно быть модальное окно с просмотром всей информации записи, без возможности редактирования");
                                        })()'
                                ],

                                'viewButtonUrl' => null,
                                'updateButtonUrl' => $item->id ?
                                        'Yii::app()->createUrl("/catalog/edit", array("id"=>$data["products_id"]))."?referrer[url]=retail_orders/edit&referrer[id]='.$item->id.'"' : null,
                                'deleteButtonUrl' => 'Yii::app()->createUrl("/retail_orders_products/delete", array("id"=>$data["id"]))',
                            ]

                        ],

                        /*'gridButtonsUrl' => $item->id ? [
                            'edit' => 'Yii::app()->createUrl("/retail_orders_products/edit", array("id"=>$data["id"]))',
                            'delete' => 'Yii::app()->createUrl("/retail_orders_products/delete", array("id"=>$data["id"]))',
                        ] : [
                            'delete' => 'Yii::app()->createUrl("/retail_orders_products/delete", array("id"=>$data["id"]))'
                        ]*/
                    ]
                );
                ?>
            </div>
        </div>
    </fieldset>
</div>
<br><br>
<input type="hidden" name="form_action" value="save">
<?php $this->endWidget(); ?>
</div>