<?php

// todo: создать виджет с предопределенными параметрами таблицы
$this->widget(
    'yiiwheels.widgets.grid.WhGridView',
    array(
        'id' => 'categoriesgrid',
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
                    'name' => 'categoryids[]'
                ],
                // todo: перенести в виджет
                'headerTemplate' => '<label>{item}<span class="lbl"></span></label>',
                'value' => '$data["id"]',
                'checked' => null,
            ],
            [
                'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                'type' => 'text',
                'header' => 'ID',
                'name' => 'id',
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
                'header' => 'ID родтельской категории',
                'name' => 'parent_id',
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
                'header' => 'Дата добавления',
                'name' => 'added',
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
                'header' => 'Изменен',
                'name' => 'modified',
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
                'header' => 'Статус',
                'name' => 'status',
                'headerHtmlOptions' => [
                    //                    'style' => 'text-align: center;'
                ],
                'htmlOptions' => [
                    //                    'style' => 'text-align: center;'
                ],
            ],
            [
                'header' => 'XML',
                'name' => 'xml_flag',
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
                    'onClick'=>'js: (function(){
                        bootbox.alert("Здесь должно быть модальное окно с просмотром всей информации пользователя, без возможности редактирования");
                    })()'
                ],
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                'viewButtonUrl' => null,//'Yii::app()->createUrl("/users/show", array("id"=>$data["id"]))',
                'updateButtonUrl' => 'Yii::app()->createUrl("/users/edit", array("id"=>$data["id"]))',
                'deleteButtonUrl' => 'Yii::app()->createUrl("/users/delete", array("id"=>$data["id"]))',
            ]
        ),
    )
);
?>
</div>