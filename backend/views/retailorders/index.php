<?php
// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/retailorders/add"),
    BackendPageButtons::remove("/retailorders/delete"),
    BackendPageButtons::mass("/retailorders/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        //'submenu' => BackendSubMenu::retailOrders(),

        'filter' => [
            // фильтр по статусу
            TbHtml::dropDownList(
                'filter_status',
                !empty($criteria['filters']['retail_orders_statuses_id']) ? : null,
                array_merge([''=>'- По статусу -'],$statuses),
                [
                    'onChange' => 'js: (function(){
                    $.fn.yiiGridView.update(
                        "whgrid",
                        {
                            data:{
                                "filters[retail_orders_statuses_id]":$("#filter_status").val()
                            }
                        }
                    )
                })()'
                ]
            ),

            // фильтр по точкам доставки
            /*TbHtml::dropDownList(
                'filter_deliverypoint',
                !empty($criteria['filters']['delivery_points_id']) ? : null,
                array_merge([''=>'- По точке доставки -'],$deliveryPoints),
                [
                    'onChange' => 'js: (function(){
                    $.fn.yiiGridView.update(
                        "whgrid",
                        {
                            data:{
                                "filter[delivery_points_id]":$("#filter_deliverypoint").val()
                            }
                        }
                    )
                })()'
                ]
            )*/
        ],

        'order' => [
            'active' => $criteria['order']['field'],
            'fields' => [
                'customers_name' => 'Имя покупателя',
                'customers_telephone' => 'Телефон покупателя',
                //'customers_company' => 'Компания покупателя',
                'customers_city' => 'Город покупателя',
                'retail_orders_statuses_id' => 'Статус заказа',
                //'delivery_points_id' => 'Точка доставки',
                'date_purchased' => 'Дата создания',
            ],
            'direct' => $criteria['order']['direction']
        ],

        'pageSize' => $criteria['page_size'],

        'textSearch' => $criteria['text_search'],

        'dataProvider' => $gridDataProvider,

        'gridColumns' => [
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'customers_name',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/retailorders/update"),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'customers_telephone',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/retailorders/update"),
                ]
            ],
            /*[
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'customers_company',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/retailorders/update"),
                ]
            ],*/
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'customers_city',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/retailorders/update"),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'name' => 'retail_orders_statuses_id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'type' => 'select',
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/retailorders/update"),
                    'source' => $statuses,
                ]
            ],
            /*[
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'name' => 'delivery_points_id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'type' => 'select',
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/retailorders/update"),
                    'source' => $deliveryPoints,
                ]
            ],*/
            [
                'name' => 'date_purchased',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/retailorders/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/retailorders/delete", array("id"=>$data["id"]))',
        ]
    ]
);