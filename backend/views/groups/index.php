<?php

// кнопки
$this->pageButton = [
    BackendPageButtons::add("/groups/add"),
    BackendPageButtons::remove("/groups/mass"),
    BackendPageButtons::mass("/groups/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::users(),

//        'filter' => [
//
//        ],

        'order' => [
            'active' => $criteria['order_field'],
            'fields' => [
                'name' => 'Название',
                'id' => 'ID'
            ],
            'direct' => $criteria['order_direct']
        ],

        'pageSize' => $page_size,

        'textSearch' => $criteria['text_search'],

        'dataProvider' => $this->gridDataProvider,

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
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/groups/update"),
                    //'source'   => $this->createUrl('users/update'),
                ]
            ],
            [
                'header' => 'ID',
                'name' => 'id',
                'headerHtmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ]
            ]
        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/groups/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/groups/delete", array("id"=>$data["id"]))',
        ]
    ]
);