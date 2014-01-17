<?php

?>
<h1>Users</h1>
<?php
$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id'=>'usersgrid',
    'dataProvider'=>$this->gridDataProvider,
    //'itemsCssClass' => 'table-bordered items',
    'fixedHeader' => true,
    'responsiveTable' => true,
    'type' => 'striped bordered',
    'columns'=>array(
        [
            'header' => 'Id',
            'name'=>'admin_groups_id',
            'headerHtmlOptions' => array('style' => 'width: 30px; text-align: center;'),
            'htmlOptions' => array('style' => 'width: 30px; text-align: center;'),
        ],
        [
            'header' => 'Group_id',
            'name'=>'admin_groups_id',
            'headerHtmlOptions' => array('style' => 'width: 50px; text-align: center;'),
            'htmlOptions' => array('style' => 'width: 50px; text-align: center;'),
        ],
        [
            'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
            'type' => 'text',
            'header' => 'Имя',
            'name' => 'admin_firstname',
            'headerHtmlOptions' => array('style' => 'text-align: center;'),
            'htmlOptions' => array('style' => 'text-align: center;'),
            'editable'=>[
            'placement' => 'right'
            ]
        ],
        [
            'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
            'type' => 'text',
            'header' => 'Фамилия',
            'name' => 'admin_lastname',
            'headerHtmlOptions' => array('style' => 'text-align: center;'),
            'htmlOptions' => array('style' => 'text-align: center;'),
            'editable'=>[
                'placement' => 'right'
            ]
        ],
        [
            'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
            'type' => 'text',
            'header' => 'E-mail',
            'name' => 'admin_email_address',
            'headerHtmlOptions' => array('style' => 'text-align: center;'),
            'htmlOptions' => array('style' => 'text-align: center;'),
            'editable'=>[
                'placement' => 'right'
            ]
        ],
        [
            'header' => 'Log_date',
            'name'=>'admin_logdate',
            'headerHtmlOptions' => array('style' => 'text-align: center;'),
            'htmlOptions' => array('style' => 'text-align: center;'),
        ],
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),

        ),
    ),
));

 ?>

<?php
//$this->widget('bootstrap.widgets.TbGridView', array(
//    'id' => 'usergrid',
//    'itemsCssClass' => 'table-bordered items',
//    'dataProvider' => $this->gridDataProvider,
//    'columns'=>array(
//        array(
//            'class' => 'editable.EditableColumn',
//            'name' => 'user_name',
//            'headerHtmlOptions' => array('style' => 'width: 110px'),
//            'editable' => array( //editable section
//                'apply' => '$data->user_status != 4', //can't edit deleted users
//                'url' => $this->createUrl('site/updateUser'),
//                'placement' => 'right',
//            )
//        ),
//        array(
//            'class' => 'editable.EditableColumn',
//            'name' => 'user_status',
//            'headerHtmlOptions' => array('style' => 'width: 100px'),
//            'editable' => array(
//                'type' => 'select',
//                'url' => $this->createUrl('site/updateUser'),
//                'source' => $this->createUrl('site/getStatuses'),
//                'options' => array( //custom display
//                    'display' => 'js: function(value, sourceData) {
//    var selected = $.grep(sourceData, function(o){ return value == o.value; }),
//    colors = {1: "green", 2: "blue", 3: "red", 4: "gray"};
//    $(this).text(selected[0].text).css("color", colors[value]);
//    }'
//                ),
//                //onsave event handler
//                'onSave' => 'js: function(e, params) {
//    console && console.log("saved value: "+params.newValue);
//    }',
//                //source url can depend on some parameters, then use js function:
//                /*
//                'source' => 'js: function() {
//                var dob = $(this).closest("td").next().find(".editable").text();
//                var username = $(this).data("username");
//                return "?r=site/getStatuses&user="+username+"&dob="+dob;
//                }',
//                'htmlOptions' => array(
//                'data-username' => '$data->user_name'
//                )
//                */
//            )
//        ),
//        array(
//            'class' => 'editable.EditableColumn',
//            'name' => 'user_dob',
//            'headerHtmlOptions' => array('style' => 'width: 100px'),
//            'editable' => array(
//                'type' => 'date',
//                'viewformat' => 'dd.mm.yyyy',
//                'url' => $this->createUrl('site/updateUser'),
//                'placement' => 'right',
//            )
//        ),
//        array(
//            'class' => 'editable.EditableColumn',
//            'name' => 'user_comment',
//            'editable' => array(
//                'type' => 'textarea',
//                'url' => $this->createUrl('site/updateUser'),
//                'placement' => 'left',
//            )
//        ),
//        //editable related attribute with sorting.
//        //see http://www.yiiframework.com/wiki/281/searching-and-sorting-by-related-model-in-cgridview
//        array(
//            'class' => 'editable.EditableColumn',
//            'name' => 'virtual_field',
//            'value' => 'CHtml::value($data, "profile.language")',
//            'editable' => array(
//                'type' => 'text',
//                'attribute' => 'profile.language',
//                'url' => $this->createUrl('site/updateProfile'),
//                'placement' => 'left',
//            )
//        ),
//    ),
//));
?>