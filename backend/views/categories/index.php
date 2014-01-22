<?php
//Yii::app()->getComponent('yiiwheels')->registerAssetJs('bootbox.min.js');
$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'type' => 'striped bordered',
    'dataProvider' => $this->gridDataProvider,
    'template' => "{items}",
    'columns' => array(
        [
            'class' => 'yiiwheels.widgets.grid.WhRelationalColumn',
            'name' => 'subGrid',
            'url' => $this->createUrl('categories/index/'.$data['id']),
            'value' => '"Развернуть"',
//            'afterAjaxUpdate' => 'js:function(tr,id,data){
//bootbox.alert("I have afterAjax events too!<br/>This will only happen once for row with id: "+rowid);
//}'
        ],
     //Person::getGridColumns()
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
    )
    )
);
?>