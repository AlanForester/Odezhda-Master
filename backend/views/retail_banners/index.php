<?php
// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/retail_banners/add"),
    BackendPageButtons::remove("/retail_banners/mass"),
    BackendPageButtons::mass("/retail_banners/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::retailInfo(),

        'filter' => [],

        'order' => [
            'active' => $criteria['order_field'],
            'fields' => [
                'name' => 'Название',
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
                'name' => 'name',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/retail_banners/update"),
                ]
            ],
            [
                'name' => 'id',
                'headerHtmlOptions' => [
                    'width'=>'50'
                ],
                'htmlOptions' => [
                ],
            ],
        ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/retail_banners/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/retail_banners/delete", array("id"=>$data["id"]))',
        ]
    ]
);