<?php $this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'fixedHeader' => true,
    'headerOffset' => 40,
    'type' => 'striped',
    'dataProvider' => $gridDataProvider,
    'responsiveTable' => true,
    'template' => "{items}",
        'itemsCssClass' => 'tree table-bordered items',
        //    'filter'=>$this->model,
        'htmlOptions' => [
            'class' => 'grid-view dataTables_wrapper'
        ],

        'selectableRows' => 2, // если 0 или 1 - чекбоксы перестают работать

        'emptyText' => 'Нет данных для отображения',

        // todo: pager - сделать tooltip на кнопки
        'template' => '
                    <div class="table-block">{items}</div>
                    <div class="row pager-block">
                        <div class="span6 pull-right">{summary}</div>
                        <div class="span6 pull-left">{pager}</div>
                    </div>
                    ',
        'summaryText' => 'Отображено записей {start}-{end} из {count}',
        'columns' => [
        [
                'class' => 'backend.widgets.ace.CheckBoxColumn',

                'checkBoxHtmlOptions' => [
                    'name' => 'gridids[]'
                ],
                // todo: перенести в виджет
                'headerTemplate' => '<label>{item}<span class="lbl"></span></label>',
//                'value' => $this->gridIdData,
                'checked' => null,
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
            'header' => 'Родительская категория',
            'name' => 'parent_id',
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
                                bootbox.alert("Здесь должно быть модальное окно с просмотром всей информации записи, без возможности редактирования");
                            })()'
        ],
        'class' => 'bootstrap.widgets.TbButtonColumn',
        'afterDelete' => 'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

        'viewButtonUrl' => null, //$this->gridButtonsUrl['show'],
        'updateButtonUrl' => null,
        'deleteButtonUrl' => null,
    ]
    ],
)); ?>