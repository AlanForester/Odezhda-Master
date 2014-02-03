<?php
// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/retailorders/add"),
    BackendPageButtons::remove("/retailorders/delete")/*,
    BackendPageButtons::mass("/retailorders/mass")*/
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
                $criteria['filter_status'],
                array_merge([''=>'- По статусу -'],$statuses),
                [
                    'onChange' => 'js: (function(){
                    $.fn.yiiGridView.update(
                        "whgrid",
                        {
                            data:{
                                filter_status:$("#filter_status").val()
                            }
                        }
                    )
                })()'
                ]
            ),

            // фильтр по точкам доставки
            TbHtml::dropDownList(
                'filter_deliverypoint',
                $criteria['filter_deliverypoint'],
                array_merge([''=>'- По точке доставки -'],$deliveryPoints),
                [
                    'onChange' => 'js: (function(){
                    $.fn.yiiGridView.update(
                        "whgrid",
                        {
                            data:{
                                filter_deliverypoint:$("#filter_deliverypoint").val()
                            }
                        }
                    )
                })()'
                ]
            )
        ],

        'order' => [
            'active' => $criteria['order_field'],
            'fields' => [
                'firstname' => 'Имя',
                'lastname' => 'Фамилия',
                'email' => 'E-Mail',
                'retail_orders_statuses_id' => 'Статус',
                'logdate' => 'Последний визит',
                'id' => 'ID',
            ],
            'direct' => $criteria['order_direct']
        ],

        'pageSize' => $criteria['page_size'],

        'textSearch' => $criteria['text_search'],

        'dataProvider' => $gridDataProvider,

        'gridColumns' => [
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
//                'header' => 'Имя',
                'name' => 'firstname',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/retailorders/update"),
                    //'source'   => $this->createUrl('retailorders/update'),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
//                'header' => 'Фамилия',
                'name' => 'lastname',
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
//                'header' => 'E-mail',
                'name' => 'email',
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
            [
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
            ],
            [
//                'header' => 'Последний визит',
                'name' => 'logdate',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
//                'header' => 'Id',
                'name' => 'id',
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