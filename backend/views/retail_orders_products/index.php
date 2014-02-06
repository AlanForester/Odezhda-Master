<?php

if(Yii::app()->controller->action->id == 'order') {
    $buttonLabels = ['Добавить в заказ','Удалить из заказа'];
    $submenu = BackendSubMenu::retailOrder($id);
    $filter = [];

} else {
    $this->pageTitle = 'Товары в розничных заказах: список';
    $buttonLabels = ['Добавить','Удалить'];
    $submenu = [];
    $filter = [
        TbHtml::dropDownList(
            'filter_retail_order',
            $criteria['filters']['retail_orders_id'],
            array_merge([''=>'- По розн. заказу -'],$retailOrders),
            [
                'onChange' => 'js: (function(){
                    $.fn.yiiGridView.update(
                        "whgrid",
                        {
                            data:{
                                "filters[retail_orders_id]":$("#filter_retail_order").val()
                            }
                        }
                    )
                })()'
            ]
        ),
    ];
}

$this->pageButton = [
    BackendPageButtons::add("/retail_orders_products/add/".$id, [], $buttonLabels[0]),
    BackendPageButtons::remove("/retail_orders_products/mass", [], $buttonLabels[1]),
    BackendPageButtons::mass("/retail_orders_products/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => $submenu,

        'filter' => $filter,

        'order' => [
            'active' => $criteria['order']['field'],
            'fields' => [
                'products_name' => 'Название',
                'products_model' => 'Код',
                'products_quantity' => 'Количество',
                'products_price' => 'Цена',
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
                'name' => 'products_name',
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
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'products_model',
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
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'products_quantity',
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
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'products_price',
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


        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/retail_orders_products/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/retail_orders_products/delete", array("id"=>$data["id"]))',
        ]
    ]
);