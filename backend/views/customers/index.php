<?php
// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/customers/add"),
    BackendPageButtons::remove("/customers/mass"),
    BackendPageButtons::mass("/customers/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::customers(),

        'filter' => [
            // фильтр по группам
            TbHtml::dropDownList(
                'filter_groups',
                !empty($criteria['filters']['groups_id']) ? : null,
                array_merge([''=>'- По статусу -'],$groups),
                [
                    'onChange' => 'js: (function(){
                    $.fn.yiiGridView.update(
                        "whgrid",
                        {
                            data:{
                                "filters[groups_id]":$("#filter_groups").val()
                            }
                        }
                    )
                })()'
                ]
            ),
        ],

        'order' => [
            'active' => $criteria['order']['field'],
            'fields' => [
                'firstname' => 'Имя',
                'lastname' => 'Фамилия',
                'phone' => 'Телефон',
                'email' => 'E-Mail',
            ],
            'direct' => $criteria['order']['direction']
        ],

        'pageSize' => $criteria['page_size'],

        'textSearch' => $criteria['text_search'],

        'dataProvider' => $gridDataProvider,

        'gridColumns' => [
            [
                'name' => 'id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'firstname',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/customers/update"),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'lastname',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/customers/update"),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'email',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/customers/update"),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'phone',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/customers/update"),
                ]
            ],
        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/customers/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/customers/delete", array("id"=>$data["id"]))',
        ]
    ]
);