<?php
// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/orders/add"),
    BackendPageButtons::remove("/orders/mass"),
    BackendPageButtons::mass("/orders/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::orders(),

//        'filter' => [
//            // фильтр по группе
//            TbHtml::dropDownList(
//                'filter_groups',
//                $criteria['filter_groups'],
//                array_merge([''=>'- По группе -'],$groups),
//                [
//                    'onChange' => 'js: (function(){
//                    $.fn.yiiGridView.update(
//                        "whgrid",
//                        {
//                            data:{
//                                filter_groups:$("#filter_groups").val()
//                            }
//                        }
//                    )
//                })()'
//                ]
//            ),
//
//            // фильтр по дате регистрации
//            TbHtml::dropDownList(
//                'filter_created',
//                $criteria['filter_created'],
//                [
//                    '0' => '- По дате регистрации -',
//                    'today' => 'сегодня',
//                    'past_week' => 'за прошлую неделю',
//                    'past_1month' => 'за прошлый месяц',
//                    'past_3month' => 'последние 3 месяца',
//                    'past_6month' => 'последние 6 месяцев',
//                    'past_year' => 'за прошлый год',
//                    'post_year' => 'больше года назад',
//                ],
//                [
//                    'onChange' => 'js: (function(){
//                    $.fn.yiiGridView.update(
//                        "whgrid",
//                        {
//                            data:{
//                                filter_created:$("#filter_created").val()
//                            }
//                        }
//                    )
//                })()'
//                ]
//            )
//        ],

//        'order' => [
//            'active' => $criteria['order_field'],
//            'fields' => [
//                'firstname' => 'Имя',
//                'lastname' => 'Фамилия',
//                'email' => 'E-Mail',
//                'group_id' => 'Группа',
//                'logdate' => 'Последний визит',
//                'id' => 'ID',
//            ],
//            'direct' => $criteria['order_direct']
//        ],

        'pageSize' => $criteria['page_size'],

        'textSearch' => $criteria['text_search'],

        'dataProvider' => $gridDataProvider,

        'gridColumns' => [
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
//                'header' => 'Имя',
                'name' => 'id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
//                'header' => 'Имя',
                'name' => 'sum',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
//                'header' => 'Имя',
                'name' => 'customers_name',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/orders/update"),
                    //'source'   => $this->createUrl('users/update'),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                //                'header' => 'Группа',
                'name' => 'default_provider',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'type' => 'select',
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/orders/update"),
                    'source' => [
                        '1' => 'ИП Гаврилин А. А.',
                        '2' => 'ИП Шепелев Д. Н.'
                    ]
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                //                'header' => 'Группа',
                'name' => 'orders_status_id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'type' => 'select',
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/orders/update"),
                    'source' => [
                        '1' => 'Ожидает проверки',
                        '2' => 'Ждём оплаты',
                        '3' => 'Оплачен',
                        '4' => 'Оплачен - Доставляется',
                        '5' => 'Оплачен - Доставлен',
                        '6' => 'Отменён'
                    ]
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
//                'header' => 'Дата покупки',
                'name' => 'date_purchased',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/orders/update"),
                    //'source'   => $this->createUrl('users/update'),
                ]
            ],
        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/orders/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/orders/delete", array("id"=>$data["id"]))',
        ]
    ]
);