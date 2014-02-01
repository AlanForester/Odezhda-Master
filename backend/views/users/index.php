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
                array_merge([''=>'- По группе -'],$groups),
                [
                    'onChange' => 'js: (function(){
                    $.fn.yiiGridView.update(
                        "whgrid",
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
                        "whgrid",
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
                    'url' => Yii::app()->createUrl("/users/update"),
                    //'source'   => $this->createUrl('users/update'),
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
                    'url' => Yii::app()->createUrl("/users/update"),
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
                    'url' => Yii::app()->createUrl("/users/update"),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
//                'header' => 'Группа',
                'name' => 'group_id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'type' => 'select',
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/users/update"),
                    'source' => $groups //$this->createUrl('groups/list'),
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
            'edit' => 'Yii::app()->createUrl("/users/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/users/delete", array("id"=>$data["id"]))',
        ]
    ]
);