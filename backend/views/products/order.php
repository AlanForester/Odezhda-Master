<?php
// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/products/add", [], 'Добавить в заказ'),
    BackendPageButtons::remove("/products/delete", [], 'Удалить из заказа'),
    BackendPageButtons::mass("/products/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::retailOrder($orderId),

        'filter' => [
            // фильтр по статусу
            /*TbHtml::dropDownList(
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
            ),*/
        ],

        'order' => [
            'active' => $criteria['order_field'],
            'fields' => [
                'products_name' => 'Название',
                'products_model' => 'Код',
                'products_price' => 'Цена',

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
                'name' => 'products_name',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/products/update"),
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
                    'url' => Yii::app()->createUrl("/products/update"),
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
                    'url' => Yii::app()->createUrl("/products/update"),
                ]
            ],


        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/products/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/products/delete", array("id"=>$data["id"]))',
        ]
    ]
);