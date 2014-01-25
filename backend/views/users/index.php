<?php

// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/users/add"),
    BackendPageButtons::remove("/users/mass"),
    BackendPageButtons::mass("/users/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::users(),

        'filter' => [
            // фильтр по группе
            TbHtml::dropDownList(
                'filter_groups',
                $criteria['filter_groups'],
                $this->groups,
                [
                    'onChange' => 'js: (function(){
                    $.fn.yiiGridView.update(
                        "usersgrid",
                        {
                            data:{
                                filter_groups:$("#filter_groups").val()
                            }
                        }
                    )
                })()'
                ]
            ),

            // фильтр по дате регистрации
            TbHtml::dropDownList(
                'filter_created',
                $criteria['filter_created'],
                [
                    '0' => '- По дате регистрации -',
                    'today' => 'сегодня',
                    'past_week' => 'за прошлую неделю',
                    'past_1month' => 'за прошлый месяц',
                    'past_3month' => 'последние 3 месяца',
                    'past_6month' => 'последние 6 месяцев',
                    'past_year' => 'за прошлый год',
                    'post_year' => 'больше года назад',
                ],
                [
                    'onChange' => 'js: (function(){
                    $.fn.yiiGridView.update(
                        "usersgrid",
                        {
                            data:{
                                filter_created:$("#filter_created").val()
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
                'group_id' => 'Группа',
                'logdate' => 'Последний визит',
                'id' => 'ID',
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
                'header' => 'Имя',
                'name' => 'firstname',
                'headerHtmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/users/update"),
                    //'source'   => $this->createUrl('users/update'),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Фамилия',
                'name' => 'lastname',
                'headerHtmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/users/update"),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'E-mail',
                'name' => 'email',
                'headerHtmlOptions' => [
                    //                    'style' => 'text-align: center;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: center;'
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/users/update"),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'header' => 'Группа',
                'name' => 'group_id',
                'headerHtmlOptions' => [
                    //                    'style' => 'width: 200px; text-align: center;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'width: 200px; text-align: center;'
                ],
                'editable' => [
                    'type' => 'select',
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/users/update"),
                    'source' => $this->createUrl('groups/list'),
                ]
            ],
            [
                'header' => 'Последний визит',
                'name' => 'logdate',
                'headerHtmlOptions' => [
                    //                    'style' => 'text-align: center;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: center;'
                ],
            ],
            [
                'header' => 'Id',
                'name' => 'id',
                'headerHtmlOptions' => [
                    //                    'style' => 'width: 30px; text-align: center;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'width: 30px; text-align: center;'
                ],
            ],
        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/users/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/users/delete", array("id"=>$data["id"]))',
        ]
    ]
);