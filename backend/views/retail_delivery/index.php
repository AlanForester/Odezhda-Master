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
                'name' => 'Название',
                'description' => 'Описание',
                'id' => 'ID',
                'ordering' => 'По позиции',
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
                    'url' => Yii::app()->createUrl("/retail_delivery/update"),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'name' => 'description',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/retail_delivery/update"),
                ]
            ],
            [
                'name' => 'id',
                'headerHtmlOptions' => [
                    'width'=>'50'
                ],
                'htmlOptions' => [
                    'style'=>'text-align: center'
                ],
            ],[
                'name' => 'ordering',
                'headerHtmlOptions' => [
                    'width'=>'50'
                ],
                'htmlOptions' => [
                    'style'=>'text-align: center'
                ],
            ],
        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/retail_delivery/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/retail_delivery/delete", array("id"=>$data["id"]))',
        ]
    ]
);