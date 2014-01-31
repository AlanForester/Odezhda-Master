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
            // фильтр по группе
//            TbHtml::dropDownList(
//                'filter_categories',
//                $criteria['filter_categories'],
//                $this->categories,
//                [
//                    'onChange' => 'js: (function(){
//                    $.fn.yiiGridView.update(
//                        "whgrid",
//                        {
//                            data:{
//                                filter_categories:$("#filter_categories").val()
//                            }
//                        }
//                    )
//                })()'
//                ]
//            ),

            // фильтр по дате регистрации
//            TbHtml::dropDownList(
//                'filter_created',
//                $criteria['filter_created'],
//                [
//                    '0' => '- По дате добавления -',
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
        ],


        'order' => [
            'active' => $criteria['order_field'],
            'fields' => [
                //                'firstname' => 'Имя',
                'name' => 'Название',
                //                'email' => 'E-Mail',
                //                'group_id' => 'Группа',
                //                'logdate' => 'Последний визит',
                'id' => 'ID',
            ],
            'direct' => $criteria['order_direct']
        ],

//        'pageSize' => $page_size,

        'textSearch' => $criteria['text_search'],

        'dataProvider' => $gridDataProvider,

        //        'gridOptions'=>[
        //            'id' => 'tree_id' . $id
        //        ],

        'gridTree' => true,

        'gridColumns' => [
//            [
//                'class' => 'yiiwheels.widgets.grid.WhRelationalColumn',
//
//                //            'name' => 'subGrid',
//                'url' => $this->createUrl('categories/index', ['ajax' => '1']),
//                'value' => '"Развернуть"',
//                'htmlOptions' => [
//                    'class' => 'action-buttons',
//                    'width' => '50px'
//                ],
//                'afterAjaxUpdate' => 'js:function(tr,id,data){
//                        $("#tree_id0").trigger("ajaxUpdate.editable");
//                    }'
//            ],
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
                'header' => 'Родительская категория',
                'name' => 'parent_id',
                'headerHtmlOptions' => [
                    'width' => '200px'
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'header' => 'Дочерние подкатегории',
                'name' => 'childCount',
                'headerHtmlOptions' => [
                    'width' => '200px'
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
