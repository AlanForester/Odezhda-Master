<?php

$this->pageTitle = 'Менеджер клиентов: ' . ($item->id ? 'редактирование [' . $item->email . ']' : 'новый клиент');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/customers/index", [], 'Отмена', $referrer)
];
?>
<div class="span12">
    <div class="span6">
        <?php
        /**
         * @var TbActiveForm $form
         * @var UsersController $this
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

        );?>
        <fieldset>
            <legend>Учетная запись</legend>
            <?php
            echo $form->hiddenField($item, 'id', []);
            echo $form->dropDownListControlGroup($item, 'group_id', $groups, []);
            echo $form->textFieldControlGroup($item, 'firstname', []);
            echo $form->textFieldControlGroup($item, 'middlename', []);
            echo $form->textFieldControlGroup($item, 'lastname', []);
            echo $form->passwordFieldControlGroup($item, 'password', ['autocomplete' => 'off', 'value' => '']);
            echo $form->dropDownListControlGroup($item, 'gender', $genders, []);
            //echo $form->dateFieldControlGroup($item, 'dob', []);
            echo $form->dateTimePickerControlGroup($item, 'dob', [
                'pluginOptions' => [
                    'format' => 'yyyy-MM-dd hh:mm:ss',
                    'language' => 'ru'
                ],
            ]);
            echo $form->textFieldControlGroup($item, 'email', []);
            echo $form->textFieldControlGroup($item, 'phone', []);
            echo $form->textFieldControlGroup($item, 'fax', []);
            //echo $form->dropDownListControlGroup($item, 'default_address_id', $addresses, []);
            //echo $form->dropDownListControlGroup($item, 'delivery_address_id', $addresses, []);
            //echo $form->dropDownListControlGroup($item, 'pay_address_id', $addresses, []);
            //echo $form->dropDownListControlGroup($item, 'newsletter', $newsletters, []);
            //echo $form->textFieldControlGroup($item, 'selected_template', []);
            echo $form->dropDownListControlGroup($item, 'guest_flag', $yesNo, []);
            //echo $form->dropDownListControlGroup($item, 'status', $statuses, []);
            echo $form->dropDownListControlGroup($item, 'payment_allowed', $yesNo, []);
            echo $form->dropDownListControlGroup($item, 'shipment_allowed', $yesNo, []);
            echo $form->textFieldControlGroup($item, 'referer', []);
            //echo $form->dropDownListControlGroup($item, 'default_provider', $providers, []);
            echo $form->textAreaControlGroup($item, 'comment', []);
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
                $this->widget(
                    'yiiwheels.widgets.detail.WhDetailView',
                    [
                        'data' => $item->customers_info,
                        'attributes' => [
                            ['name' => 'id'],
                            ['name' => 'logon_count'],
                            ['name' => 'last_logon'],
                            ['name' => 'modified'],
                            ['name' => 'created'],
                        ],
                    ]
                );
                ?>
            </fieldset>
        </div>
    <?php
    }
    ?>
</div>

<!--
<div class="row-fluid">
    <fieldset>
        <legend>Адресная книга: список</legend>
        <div class="container-fluid">
            <div class="row-fluid">
                <div style="padding-bottom: 16px" class="span12 pull-left button-block">
                    <?php
                    /*echo BackendPageButtons::addAddress($item->id)
                        . BackendPageButtons::removeAddress("/address_book/mass/", $item->id)
                        . BackendPageButtons::mass("/address_book/mass/".$item->id)*/
                    ?>
                </div>
            </div>
        </div>
        <div>
            <div class="span12">
                <?php
                /*$this->widget(
                    'backend.widgets.CompactGrid',
                    [
                        'gridId' => 'abgrid',

                        'selectableRows' => 2,

                        'pageSize' => $addressesCriteria['page_size'],

                        'dataProvider' => $addressesGridDataProvider,

                        'gridColumns' => [
                            [
                                'header' => 'Название',
                                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                                'type' => 'text',
                                'name' => 'name',
                                'headerHtmlOptions' => [
                                ],
                                'htmlOptions' => [
                                ],
                                'editable' => [
                                    'placement' => 'right',
                                    'emptytext' => 'не задано',
                                    'url' => Yii::app()->createUrl("/address_book/update"),
                                ]
                            ],
                            [
                                'header' => 'Код модели',
                                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                                'type' => 'text',
                                'name' => 'model',
                                'headerHtmlOptions' => [
                                ],
                                'htmlOptions' => [
                                ],
                                'editable' => [
                                    'placement' => 'right',
                                    'emptytext' => 'не задано',
                                    'url' => Yii::app()->createUrl("/address_book/update"),
                                ]
                            ],
                            [
                                'header' => 'Количество',
                                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                                'type' => 'text',
                                'name' => 'quantity',
                                'headerHtmlOptions' => [
                                ],
                                'htmlOptions' => [
                                ],
                                'editable' => [
                                    'placement' => 'right',
                                    'emptytext' => 'не задано',
                                    'url' => Yii::app()->createUrl("/address_book/update"),
                                ]
                            ],
                            [
                                'header' => 'Цена (за единицу)',
                                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                                'type' => 'text',
                                'name' => 'price',
                                'headerHtmlOptions' => [
                                ],
                                'htmlOptions' => [
                                ],
                                'editable' => [
                                    'placement' => 'right',
                                    'emptytext' => 'не задано',
                                    'url' => Yii::app()->createUrl("/address_book/update"),
                                ]
                            ],
                            [
                                'header' => 'ID',
                                'name' => 'id',
                                'headerHtmlOptions' => [
                                ],
                                'htmlOptions' => [
                                ],
                            ],

                        ],

                        'gridButtonsUrl' => $item->id ? [
                            'edit' => 'Yii::app()->createUrl("/address_book/edit", array("id"=>$data["id"]))',
                            'delete' => 'Yii::app()->createUrl("/address_book/delete", array("id"=>$data["id"]))',
                        ] : [
                            'delete' => 'Yii::app()->createUrl("/address_book/delete", array("id"=>$data["id"]))'
                        ]
                    ]
                );*/
                ?>
            </div>
        </div>
    </fieldset>
</div>
<br><br>
-->