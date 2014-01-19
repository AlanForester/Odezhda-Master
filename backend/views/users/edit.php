<?php
//print_r($model);exit;
$this->pageTitle = 'Редактирование [' . $model->email_address . ']';
$this->pageButton = [
    TbHtml::htmlButton(
        'Сохранить',
        [
            'icon' => TbHtml::ICON_PENCIL,
            'buttonType' => 'link',
            'url' => '#', //'/users/add',
            //            'type'=>TbHtml::BUTTON_TYPE_SUBMIT,
            'color' => TbHtml::BUTTON_COLOR_SUCCESS,
            'onClick' => 'js: (function(){
                    $("input[name=\'form_action\']").val("save");
                    $("#yw0").submit();
                })()'
        ]
    ),

    TbHtml::htmlButton(
        'Применить',
        [
            'icon' => TbHtml::ICON_OK,
            'buttonType' => 'link',
            'url' => '#',
            //            'type'=>TbHtml::BUTTON_TYPE_SUBMIT,
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'onClick' => 'js: (function(){
                    $("input[name=\'form_action\']").val("apply");
                    $("#yw0").submit();
                })()'
        ]
    ),
    TbHtml::linkButton(
        'Отмена',
        [
            'icon' => TbHtml::ICON_REMOVE,
            'buttonType' => 'link',
            'url' => Yii::app()->createUrl("/users/index"),
            //            'type'=>TbHtml::BUTTON_TYPE_LINK,
            'color' => TbHtml::BUTTON_COLOR_DANGER,
        ]
    ),
];
?>

<?php
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    )
);?>
    <fieldset>
        <?php
        //   if (!empty($model->id))
        echo $form->textFieldControlGroup($model, 'id', array('value' => $model->id, 'disabled' => true));
        ?>
        <?php
        // if (!empty($model->groups_id))
        echo $form->textFieldControlGroup($model, 'Группа', array('value' => $model->groups_id));
        ?>
        <?php
        //   if (!empty($model->firstname))
        echo $form->textFieldControlGroup($model, 'Имя', array('value' => $model->firstname));
        ?>
        <?php
        //if (!empty($model->lastname))
        echo $form->textFieldControlGroup($model, 'Фамилия', array('value' => $model->lastname));
        ?>
        <?php
        //  if (!empty($model->email_address))
        echo $form->textFieldControlGroup($model, 'Email', array('value' => $model->email_address));
        ?>
        <?php
        if (!empty($model->created))
            echo $form->textFieldControlGroup($model, 'Дата создания', array('value' => $model->created, 'disabled' => true));
        ?>
        <?php
        if (!empty($model->modified))
            echo $form->textFieldControlGroup($model, 'Дата изменения', array('value' => $model->modified, 'disabled' => true));
        ?>
        <?php
        if (!empty($model->logdate))
            echo $form->textFieldControlGroup($model, 'Последний визит', array('value' => $model->logdate, 'disabled' => true));
        ?>
        <?php
        if (!empty($model->lognum))
            echo $form->textFieldControlGroup($model, 'Количество авторизаций', array('value' => $model->lognum, 'disabled' => true));
        ?>

    </fieldset>
    <input type="hidden" name="form_action" value="save">
<?php $this->endWidget(); ?>


<?php
//$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
//    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
//    //'class'=>'span5'
//));
?>
    <!--        --><?php //echo $form->textFieldControlGroup($model, 'created', array('value'=>$user['created'], 'disabled' => true)); ?>
    <!--        --><?php //echo $form->textFieldControlGroup($model, 'modified', array('value'=>$user['modified'], 'disabled' => true)); ?>
    <!--        --><?php //echo $form->textFieldControlGroup($model, 'Последнее посещение', array('value'=>$user['logdate'], 'disabled' => true)); ?>
    <!--        --><?php //echo $form->textFieldControlGroup($model, 'Кол-во авторизаций', array('value'=>$user['lognum'], 'disabled' => true)); ?>
<?php //$this->endWidget(); ?>