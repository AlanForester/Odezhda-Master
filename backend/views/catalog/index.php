<?php
$this->pageButton = [
    BackendPageButtons::add("/catalog/add"),
    BackendPageButtons::remove("/catalog/mass"),
    BackendPageButtons::mass("/catalog/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::shop(),

        'filter' => [
            TbHtml::dropDownList(
                'filter_category',
                $criteria['filter_category'],
                $this->categories,
                [
                    'onChange' => 'js: (function(){
                    $.fn.yiiGridView.update(
                        "whgrid",
                        {
                            data:{
                                filter_category:$("#filter_category").val()
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
                'id' => 'ID',
                'name' => 'Название',
                'date_add' => 'Дата добавления',
                'date_last' => 'Дата изменения',
                'price' => 'Цена',
                'quantity' => 'Количество',
            ],
            'direct' => $criteria['order_direct']
        ],

        'pageSize' => $page_size,

        'textSearch' => $criteria['text_search'],

        'dataProvider'=>$this->gridDataProvider,

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
            ],[
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Описание',
                'name' => 'description',
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
               // todo: добиться вывода массива категорий categories_description
                'name' => 'category',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Цена (руб.)',
                'name' => 'price',
                'headerHtmlOptions' => [
                    'width'=>'150px'
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
                'headerHtmlOptions' => [
                    'width'=>'150px'
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
                'header' => 'Дата поступления',
                'name' => 'date_add',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'top',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/catalog/update")
                ]
            ],[
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Дата изменениния',
                'name' => 'date_last',
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
                'header' => 'ID',
                'name' => 'id',
                'headerHtmlOptions' => [
                    'width'=>'50px'
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