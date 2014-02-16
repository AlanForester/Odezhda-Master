<?php
// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/retail_delivery/add"),
    BackendPageButtons::remove("/retail_delivery/mass"),
    BackendPageButtons::mass("/retail_delivery/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::retail(),

        'filter' => [],

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