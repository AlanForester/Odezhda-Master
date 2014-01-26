<?php
$this->pageButton = [
    BackendPageButtons::add("/categories/add"),
    BackendPageButtons::remove("/categories/mass"),
    BackendPageButtons::mass("/categories/mass")
];

// таблица
$this->widget(
    'backend.widgets.Grid',
    [
        'submenu' => BackendSubMenu::shop(),

        'filter' => [

        ],

        'order' => [
            'active' => $criteria['order_field'],
            'fields' => [
                //                'firstname' => 'Имя',
                //                'lastname' => 'Фамилия',
                //                'email' => 'E-Mail',
                //                'group_id' => 'Группа',
                //                'logdate' => 'Последний визит',
                'id' => 'ID',
            ],
            'direct' => $criteria['order_direct']
        ],

        //'pageSize' => null,//$page_size,

        'textSearch' => $criteria['text_search'],

        'dataProvider' => $this->gridDataProvider,

        //        'gridOptions'=>[
        //            'id' => 'tree_id' . $id
        //        ],

        'gridColumns' => [[
            'class' => 'yiiwheels.widgets.grid.WhRelationalColumn',
            //            'name' => 'subGrid',
            'url' => $this->createUrl('categories/index', ['ajax' => '1']),
            'value' => '"Развернуть"',
            'htmlOptions' => [
                'class' => 'action-buttons',
                'width' => '50px'
            ],
            'afterAjaxUpdate' => 'js:function(tr,id,data){
                        $("#tree_id0").trigger("ajaxUpdate.editable");
                    }'
        ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Название',
                'name' => 'name',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
                'editable' => [
                    'placement' => 'top',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/categories/update"),
                    //'source'   => $this->createUrl('users/update'),
                ]
            ],
            [
                'header' => 'Подкатегорий',
                'name' => 'id',
                'headerHtmlOptions' => [
                    'width' => '50px'
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'header' => 'Id',
                'name' => 'id',
                'headerHtmlOptions' => [
                    'width' => '50px'
                ],
                'htmlOptions' => [
                ],
            ]],

        'gridButtonsUrl' => [
            'edit' => 'Yii::app()->createUrl("/categories/edit", array("id"=>$data["id"]))',
            'delete' => 'Yii::app()->createUrl("/categories/delete", array("id"=>$data["id"]))',
        ]
    ]
);
