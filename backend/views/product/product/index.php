<?php
$this->pageButton = [
    BackendPageButtons::add("/catalog/add"),
    BackendPageButtons::remove("/catalog/mass"),
    BackendPageButtons::mass("/catalog/mass")
];

$my_data = array(
    array(
        'text'     => 'Node 1',
        'expanded' => false, // будет развернута ветка или нет (по умолчанию)
        'children' => array(
            array(
                'text'     => 'Node 1.1',
            ),
            array(
                'text'     => 'Node 1.2',
            ),
            array(
                'text'     => 'Node 1.3',
            ),
        )
    ),
);

////print_r($this->categories);
//ob_start();
//$this->widget('CTreeView', ['data' => categories_clear]);
//$treeView=ob_get_clean();

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::shop(),

//        'filter' => [
//            TbHtml::dropDownList(
//                'filter_category',
//                $criteria['filter_category'],
//                $this->categories,
//                [
//                    'onChange' => 'js: (function(){
//                    $.fn.yiiGridView.update(
//                        "whgrid",
//                        {
//                            data:{
//                                filter_category:$("#filter_category").val()
//                            }
//                        }
//                    )
//                })()',
//                ]
//            )/*,$treeView*/
//        ],

        'order' => [
            'active' => $criteria['order_field'],
            'fields' => [
                'order'=>'Сортировка',
                'id' => 'ID',
                'name' => 'Название',
                'model' => 'Код товара',
                'date_add' => 'Дата добавления',
                'price' => 'Цена',
                'quantity' => 'Кол-во',
                'weight' => 'Вес',
                'manufacturers'=>'Производитель',
                'status'=>'Наличие',
                'xml'=>'XML',

            ],
            'direct' => $criteria['order_direct']
        ],

        //'pageSize' => $page_size,

        'textSearch' => $criteria['text_search'],

        'dataProvider'=>$gridDataProvider,

        'gridColumns' => [
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Название',
                'name' => 'name',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'top',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/catalog/update"),
                ]
            ], [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Код',
                'name' => 'model',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'top',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/catalog/update"),
                ]
            ],
            [
                'type' => 'text',
                'header' => 'Категории',
                'name' => 'categories_name_list',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
//            [
//                'type' => 'text',
//                'header' => 'Размеры',
//                'name' => 'newSizeString',
//                'headerHtmlOptions' => [
//                ],
//                'htmlOptions' => [
//                ],
//            ],
            [
                'type' => 'text',
                'header' => 'Производитель',
                'name' => 'manufacturers',
                'headerHtmlOptions' => [
                ],
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Цена (руб.)',
                'name' => 'price',
                'headerHtmlOptions' => [
                ],

                'editable' => [
                    'placement' => 'top',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/catalog/update")
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Количество',
                'name' => 'quantity',

                'editable' => [
                    'placement' => 'top',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/catalog/update")
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Покупок',
                'name' => 'count_orders'
            ],
//            [
//                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
//                'type' => 'text',
//                'header' => 'Вес (кг)',
//                'name' => 'weight',
//                'editable' => [
//                    'placement' => 'top',
//                    'emptytext' => 'не задано',
//                    'url' => Yii::app()->createUrl("/catalog/update")
//                ]
//            ],
//            [
//                'header' => 'Дата поступления',
//                'name' => 'date_add'
//
//            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Сортировка',
                'name' => 'order',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'top',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/catalog/update")
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'header' => 'XML',
                'name' => 'xml',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'type' => 'select',
                    'placement' => 'top',
                    'emptytext' => 'не задано',
                    'source' => [1 => "Да", 0 => "Нет"],
                    'url' => Yii::app()->createUrl("/catalog/update"),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Наличие',
                'name' => 'status',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'type' => 'select',
                    'placement' => 'top',
                    'emptytext' => 'не задано',
                    'source' => [1 => "Да", 0 => "Нет"],
                    'url' => Yii::app()->createUrl("/catalog/update"),
                ]
            ],
            [
                'header' => 'ID',
                'name' => 'id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ]
            ]
        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/catalog/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/catalog/delete", array("id"=>$data["id"]))',
        ]
    ]
);