<?php
//Yii::app()->user->setFlash(
//    TbHtml::ALERT_COLOR_WARNING,
//    '<h4>Внимание!</h4>'
//);

$this->pageButton = [
    TbHtml::linkButton(
        'Добавить',
        [
            'color' => TbHtml::BUTTON_COLOR_SUCCESS,
            'icon' => TbHtml::ICON_PLUS,
            'url' => Yii::app()->createUrl("/users/add"),
            'type' => 'success',
            'class'=>'btn-small'
        ]
    ),
    TbHtml::htmlButton(
        'Удалить',
        [
            'icon' => TbHtml::ICON_REMOVE,
            'url' => '#',
            'class'=>'btn-small',
            'onClick' => 'js: (function(){
                var cb = $("input[name=\'userids[]\']:checked");
                if (cb.length==0){
                    alert("Ввыберите минимум один обьект в списке");
                }else{
                    alert("Пакетное удаление еще не реализовано");
                }
            })()'
        ]
    ),
    TbHtml::htmlButton(
        'Пакетная обработка',
        [
            'icon' => TbHtml::ICON_TASKS,
            'url' => '#',
            'class'=>'btn-small',
            'onClick' => 'js: (function(){
                var cb = $("input[name=\'userids[]\']:checked");
                if (cb.length==0){
                    alert("Ввыберите минимум один обьект в списке");
                }else{
                    alert("Пакетная обработка еще не реализована");
                }
            })()'
        ]
    ),
]
?>
<div class="span2">
    <div id="sidebar">
        <h4 class="page-header">Фильтр:</h4>
        <?=
        TbHtml::dropDownList(
            'filter_groups',
            $criteria['filter_groups'],
            $this->groups,
            [
                //                'data-placeholder'=>'- По группе -',
                'class' => 'chzn-select',
                //                'style'=>'width: 200px',
                'onChange' => 'js: (function(){
                    //alert("Фильтр еще не реализован");
                    $.fn.yiiGridView.update(
                        "usersgrid",
                        {
                            data:{
                                filter_groups:$("#filter_groups").val()
                            }
                        }
                    )
                })()'
            ]
        );
        ?>
        <hr class="hr-condensed">
        <?=
        TbHtml::dropDownList(
            'filter_created',
            $criteria['filter_created'],
            [
                '0' => '- По дате регистрации -',
                'today' => 'сегодня',
                'past_week' => 'за прошлую неделю',
                'past_1month' => 'за прошлый месяц',
                'past_3month' => 'последние 3 месяца',
                'past_6month' => 'последние 6 месяцев',
                'past_year' => 'за прошлый год',
                'post_year' => 'больше года назад',
            ],
            [
                'class' => 'chzn-select',
                //                'style'=>'width: 200px',
                'onChange' => 'js: (function(){
                    //alert("Фильтр еще не реализован");
                    $.fn.yiiGridView.update(
                        "usersgrid",
                        {
                            data:{
                                filter_created:$("#filter_created").val()
                            }
                        }
                    )
                })()'
            ]
        );
        ?>
        <hr class="hr-condensed">
    </div>
</div>

<div class="span10">
<div>
    <?php
    echo TbHtml::textField(
        'text_search',
        '',
        [
            //                'class'=>'tooltip',
            'rel' => 'tooltip',
            'title' => 'Поиск по текстовым полям',
            'placeholder' => 'Поиск',
            'value' => $criteria['text_search'],
            'append' =>
                TbHtml::button(
                    '',
                    [
                        'icon' => TbHtml::ICON_SEARCH,
                        'title' => 'Искать',
                        'rel' => 'tooltip',
                        'onClick' => 'js: (function(){
                            $.fn.yiiGridView.update(
                                "usersgrid",
                                {
                                    data:{
                                        text_search:$("#text_search").val()
                                    }
                                }
                            )
                        })()'
                    ]
                ) .
                ' ' .
                TbHtml::button(
                    '',
                    [
                        'icon' => TbHtml::ICON_REMOVE,
                        'title' => 'Очистить',
                        'rel' => 'tooltip',
                        'onClick' => 'js: (function(){
                            $.fn.yiiGridView.update(
                                "usersgrid",
                                {
                                    data:{
                                        text_search:""
                                    }
                                }
                            )
                            $("#text_search").val("");
                        })()'
                    ]
                )
        ]
    );
    ?>
    <div class="btn-group pull-right">

        <div class="btn-group">
            <?php
            echo TbHtml::dropDownList(
                'order_field',
                $criteria['order_field'],
                [
                    'firstname' => 'Имя',
                    'lastname' => 'Фамилия',
                    'email' => 'E-Mail',
                    'group_id' => 'Группа',
                    'logdate' => 'Последний визит',
                    'id' => 'ID',
                ],
                [
                    'class' => 'pull-right',
                    'style' => 'width:150px;margin-left:5px;',
                    'onChange' => 'js: (function(){
                        $.fn.yiiGridView.update(
                            "usersgrid",
                            {
                                data:{
                                    order_field:$("#order_field").val()
                                }
                            }
                        )
                    })()'
                ]
            );

            ?>
        </div>

        <div class="btn-group">
            <?php
            echo TbHtml::dropDownList(
                'order_direct',
                $criteria['order_direct'],
                [
                    '' => 'Порядок отображения',
                    'down' => 'По убыванию',
                    'up' => 'По возрастанию',
                ],
                [
                    'class' => 'pull-right',
                    'style' => 'width:200px;margin-left:5px;',
                    'onChange' => 'js: (function(){
                        $.fn.yiiGridView.update(
                            "usersgrid",
                            {
                                data:{
                                    order_direct:$("#order_direct").val()
                                }
                            }
                        )
                    })()'
                ]
            );
            ?>
        </div>

        <div class="btn-group">
            <?php

            echo TbHtml::dropDownList(
                'page_size',
                $page_size,
                [
                    '5' => '5',
                    '10' => '10',
                    '15' => '15',
                    '20' => '20',
                    '25' => '25',
                    '30' => '30',
                    '50' => '50',
                    '100' => '100',
                    'all' => 'Все',
                ],
                [
                    //                    'value'=>$page_size,
                    'class' => 'pull-right',
                    'style' => 'width:70px;margin-left:5px;',
                    'onChange' => 'js: (function(){
                        $.fn.yiiGridView.update(
                            "usersgrid",
                            {
                                data:{
                                    page_size:$("#page_size").val()
                                }
                            }
                        )
                    })()'
                ]
            );
            ?>
        </div>
    </div>
</div>

<?php

// todo: создать виджет с предопределенными параметрами таблицы
$this->widget(
    'yiiwheels.widgets.grid.WhGridView',
    array(
        'id' => 'usersgrid',
        //        'CssClass'=>'dataTables_wrapper',
        'dataProvider' => $this->gridDataProvider,
        'itemsCssClass' => 'table-bordered items',
        //    'filter'=>$this->model,
        'fixedHeader' => true,
        'responsiveTable' => true,
        'type' => 'striped bordered',
        'headerOffset' => 106,
        'htmlOptions' => [
            'class' => 'grid-view dataTables_wrapper'
        ],
        'emptyText'=>'Нет данных для отображения',
        // pager - сделать tooltip на кнопки
        'template' => '<div class="table-block">{items}</div>
      <div class="row pager-block">
          <div class="span6 pull-right">{summary}</div>
          <div class="span6 pull-left">{pager}</div>
      </div>',
        'summaryText' => 'Отображение записей {start}-{end} из {count}',
        'columns' => array(
            [
                'class' => 'backend.widgets.ace.CheckBoxColumn',
                'selectableRows' => 2,
                'checkBoxHtmlOptions' => [
                    'name' => 'userids[]'
                ],
                // todo: перенести в виджет
                'headerTemplate' => '<label>{item}<span class="lbl"></span></label>',
                'value' => '$data["id"]',
                'checked' => null,
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Имя',
                'name' => 'firstname',
                'headerHtmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: left;'
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
                'header' => 'Фамилия',
                'name' => 'lastname',
                'headerHtmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: left;'
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
                'header' => 'E-mail',
                'name' => 'email',
                'headerHtmlOptions' => [
                    //                    'style' => 'text-align: center;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: center;'
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/users/update"),
                ]
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'header' => 'Группа',
                'name' => 'group_id',
                'headerHtmlOptions' => [
                    //                    'style' => 'width: 200px; text-align: center;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'width: 200px; text-align: center;'
                ],
                'editable' => [
                    'type' => 'select',
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/users/update"),
                    'source' => $this->createUrl('groups/list'),
                ]
            ],
            [
                'header' => 'Последний визит',
                'name' => 'logdate',
                'headerHtmlOptions' => [
                    //                    'style' => 'text-align: center;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: center;'
                ],
            ],
            [
                'header' => 'Id',
                'name' => 'id',
                'headerHtmlOptions' => [
                    //                    'style' => 'width: 30px; text-align: center;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'width: 30px; text-align: center;'
                ],
            ],
            [
                'header' => 'Действие',
                'htmlOptions' => [
                    'class' => 'action-buttons',
                    'width' => '50px'
                ],
                'deleteButtonOptions' => [
                    'class' => 'red bigger-130',
                    'title'=>'Удалить',
                ],
                'updateButtonOptions' => [
                    'class' => 'green bigger-130',
                    'title'=>'Изменить',
                ],
                'viewButtonOptions' => [
                    'class' => 'bigger-130',
                    'title'=>'Просмотр',
                ],
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'viewButtonUrl' => 'Yii::app()->createUrl("/users/show", array("id"=>$data["id"]))',
                'updateButtonUrl' => 'Yii::app()->createUrl("/users/edit", array("id"=>$data["id"]))',
                'deleteButtonUrl' => 'Yii::app()->createUrl("/users/delete", array("id"=>$data["id"]))',
            ]
        ),
    )
);
?>
</div>