<?php
// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/retail_orders_products/add", [], 'Добавить в заказ'),
    BackendPageButtons::remove("/retail_orders_products/delete", [], 'Удалить из заказа'),
    BackendPageButtons::mass("/retail_orders_products/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::retailOrder($id),

        'filter' => [
            // фильтр по статусу
            /*TbHtml::dropDownList(
                'filter_status',
                $criteria['filters'][''],
                array_merge([''=>'- По статусу -'],$a),
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
            ),*/
        ],

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