<?php
// кнопки страницы
$this->pageButton = [
    BackendPageButtons::add("/order/add"),
    BackendPageButtons::remove("/order/mass"),
    BackendPageButtons::mass("/order/mass")
];
// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::orders(),
        'filter' => [ ],

        'order' => [
            //'active' => $criteria['order_field'],
            'fields' => [
                'firstname' => 'Имя',
                'lastname' => 'Фамилия',
                'email' => 'E-Mail',
                'group_id' => 'Группа',
                'logdate' => 'Последний визит',
                'id' => 'ID',
                'customers_name' => 'Имя',
            ],
            //'direct' => $criteria['order_direct']

        ],

        'pageSize' => $criteria['page_size'],

        'textSearch' => $criteria['text_search'],

        'dataProvider' => $gridDataProvider,

        'gridColumns' => [ ],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/orders/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/orders/delete", array("id"=>$data["id"]))',
        ]


    ]

);