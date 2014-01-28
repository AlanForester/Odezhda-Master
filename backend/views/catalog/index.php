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
            // фильтр по категории
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
//                'firstname' => 'Имя',
//                'lastname' => 'Фамилия',
//                'email' => 'E-Mail',
//                'group_id' => 'Группа',
//                'logdate' => 'Последний визит',
                'id' => 'ID',
                'name' => 'Название'
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
                    //                    'style' => 'text-align: left;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ],
                'editable' => [
                    'placement' => 'top',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/catalog/update"),
                    //'source'   => $this->createUrl('users/update'),
                ]
            ],
//            [
//                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
//                'type' => 'text',
//                'header' => 'Описание',
//                'name' => 'description',
//                'headerHtmlOptions' => [
//                    //                    'style' => 'text-align: left;'
//                ],
//                'htmlOptions' => [
//                    //                    'style' => 'text-align: left;'
//                ],
//                'editable' => [
//                    'placement' => 'right',
//                    'emptytext' => 'не задано',
//                    'url' => Yii::app()->createUrl("/catalog/update"),
//                    //'source'   => $this->createUrl('users/update'),
//                ]
//            ],
            [
//                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Категории',
                'name' => 'category',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
//                'editable' => [
//                    'placement' => 'top',
//                    'emptytext' => 'не задано',
//                    'url' => Yii::app()->createUrl("/catalog/update")
//                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Цена (руб.)',
                'name' => 'price',
                'headerHtmlOptions' => [
                    'width'=>'150px'
                    //                    'style' => 'text-align: left;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: left;'
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
                    //                    'style' => 'text-align: left;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ]
            ]
        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/catalog/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/catalog/delete", array("id"=>$data["id"]))',
        ]
    ]
);