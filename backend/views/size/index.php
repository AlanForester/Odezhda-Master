<?php
// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/size/add"),
    BackendPageButtons::remove("/size/mass"),
    BackendPageButtons::mass("/size/mass")
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
                'value' => 'value',
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
                'header' => 'Размер',
                'name' => 'name',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'top',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/size/update"),
                ]
            ],[
                'header' => 'Старые размеры',
                'name' => 'oldSizeString',
                'htmlOptions' => [
                    'style'=>'font-size:9px;'
                ],
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
            'edit' => 'Yii::app()->createUrl("/size/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/size/delete", array("id"=>$data["id"]))',
        ]
    ]
);