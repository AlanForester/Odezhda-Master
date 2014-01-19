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
<div class="span6">
    <?php
    /**
     * @var TbActiveForm $form
     */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        [
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        ]
    );?>
    <fieldset>
        <legend>Учетная запись</legend>
        <?php
        echo $form->textFieldControlGroup($model, 'group', array('value' => $model->groups_id, 'label' => 'Группа'));
        echo $form->textFieldControlGroup($model, 'firstname', array('value' => $model->firstname, 'label' => 'Имя'));
        echo $form->textFieldControlGroup($model, 'lastname', array('value' => $model->lastname, 'label' => 'Фамилия'));
        echo $form->textFieldControlGroup($model, 'email_address', array('value' => $model->email_address, 'label' => 'Email'));
        echo $form->passwordFieldControlGroup($model, 'new_password', array('value' => '', 'label' => 'Новый пароль'));
        ?>

    </fieldset>
    <input type="hidden" name="form_action" value="save">
    <?php $this->endWidget(); ?>
</div>

<div class="span6">
    <fieldset>
        <legend>Дополнительная информация</legend>
        <?php
        $this->widget(
            'yiiwheels.widgets.detail.WhDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                    array('name' => 'id', 'label' => 'ID'),
                    array('name' => 'lognum', 'label' => 'Кол-во авторизаций'),
                    array('name' => 'logdate', 'label' => 'Последний визит'),
                    array('name' => 'modified', 'label' => 'Изменен'),
                    array('name' => 'created', 'label' => 'Создан'),
                ),
            )
        );
        ?>
    </fieldset>
</div>