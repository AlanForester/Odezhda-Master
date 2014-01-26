<?php
$this->pageButton = [
    BackendPageButtons::add("/categories/add"),
    BackendPageButtons::remove("/categories/mass"),
    BackendPageButtons::mass("/categories/mass")
];

if (!$this->isAjax) {
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
                            'active' => true

                        ],
                        [
                            'label' => 'Каталог',
                            'url' => Yii::app()->createUrl('/catalog/index'),

                        ]
                    ],
                ]
            );
            ?>
        </div>
    </div>
<?php } ?>
<div class="span<?php echo ($this->isAjax?'12':'10') ?>">

    <?php
    //Yii::app()->getComponent('yiiwheels')->registerAssetJs('bootbox.min.js');
    $this->widget(
        'yiiwheels.widgets.grid.WhGridView',
        array(
            'type' => 'striped bordered',
            'dataProvider' => $this->gridDataProvider,
            'template' => "{items}",
            'selectableRows'=>0,
            'columns' => array(
                [
                    'class' => 'yiiwheels.widgets.grid.WhRelationalColumn',
                    //            'name' => 'subGrid',
                    'url' => $this->createUrl('categories/index', ['id' => $data['id'], 'ajax' => '1']),
                    'value' => '"Развернуть"',
                    //            'afterAjaxUpdate' => 'js:function(tr,id,data){
                    //bootbox.alert("I have afterAjax events too!<br/>This will only happen once for row with id: "+rowid);
                    //}'
                ],
                //Person::getGridColumns()
                [
                    'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                    'type' => 'text',
                    'header' => 'Название',
                    'name' => 'name',
                    'headerHtmlOptions' => [
                        //                    'style' => 'text-align: left;'
                    ],
                    'htmlOptions' => [
                        //                    'style' => 'text-align: left;'
                    ],
                    'editable' => [
                        'placement' => 'right',
                        'emptytext' => 'не задано',
                        'url' => Yii::app()->createUrl("/categories/update"),
                        //'source'   => $this->createUrl('users/update'),
                    ]
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
                    'updateButtonUrl' => 'Yii::app()->createUrl("/categories/edit", array("id"=>$data["id"]))',
                    'deleteButtonUrl' => 'Yii::app()->createUrl("/categories/delete", array("id"=>$data["id"]))',
                ]
            )
        )
    );
    ?>
</div>