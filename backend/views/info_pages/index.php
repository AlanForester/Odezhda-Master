<?php
// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/info_pages/add"),
    BackendPageButtons::remove("/info_pages/mass"),
    BackendPageButtons::mass("/info_pages/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'order' => [
            'active' => $criteria['order_field'],
            'fields' => [
                'fields' => [
                    'name' => 'Название',
                    'id' => 'ID',
                ],
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
                'name' => 'name',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/info_pages/update"),
                ]
            ],
            [
                'name' => 'id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/info_pages/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/info_pages/delete", array("id"=>$data["id"]))',
        ]
    ]
);