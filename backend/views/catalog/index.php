<?php
$this->pageButton = [
    BackendPageButtons::add("/catalog/add"),
    BackendPageButtons::remove("/catalog/mass"),
    BackendPageButtons::mass("/catalog/mass")
]
?>
<div class="span2">
    <div id="sidebar">
        <h4 class="page-header">Подразделы:</h4>

        <?php
        $this->widget(
            'bootstrap.widgets.TbNav',
            [
                'items' => [
                    [
                        'label' => 'Категории',
                        'url' => Yii::app()->createUrl('/categories/index'),

                    ],
                    [
                        'label' => 'Каталог',
                        'url' => Yii::app()->createUrl('/catalog/index'),
                        'active' => true
                    ]
                ],
            ]
        );
        ?>
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
                    'name' => 'Название',
                    'id' => 'ID'
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
        'emptyText' => 'Нет данных для отображения',
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
                    'name' => 'gridids[]'
                ],
                // todo: перенести в виджет
                'headerTemplate' => '<label>{item}<span class="lbl"></span></label>',
                'value' => '$data["id"]',
                'checked' => null,
            ]   ,
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'Цена (руб.)',
                'name' => 'price',
                'headerHtmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: left;'
                ],
                'editable' => [
                    'placement' => 'right',
                    'emptytext' => 'не задано',
                    'url' => Yii::app()->createUrl("/catalog/update"),
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
            ],
            [
                'header' => 'Действие',
                'htmlOptions' => [
                    'class' => 'action-buttons',
                    'width' => '50px'
                ],
                'deleteButtonOptions' => [
                    'class' => 'red bigger-130',
                    'title' => 'Удалить',
                ],
                'updateButtonOptions' => [
                    'class' => 'green bigger-130',
                    'title' => 'Изменить',
                ],
                'viewButtonOptions' => [
                    'class' => 'bigger-130',
                    'title' => 'Просмотр',
                    'onClick' => 'js: (function(){
                        bootbox.alert("Здесь должно быть модальное окно с просмотром всей информации пользователя, без возможности редактирования");
                    })()'
                ],
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'afterDelete' => 'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                'viewButtonUrl' => null, //'Yii::app()->createUrl("/users/show", array("id"=>$data["id"]))',
                'updateButtonUrl' => 'Yii::app()->createUrl("/catalog/edit", array("id"=>$data["id"]))',
                'deleteButtonUrl' => 'Yii::app()->createUrl("/catalog/delete", array("id"=>$data["id"]))',
            ]
        ),
    )
);
?>
</div>