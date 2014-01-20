<?php
//print_r($model);exit;
if(!empty($model->id))
    $this->pageTitle = 'Менеджер пользователей: редактирование [' . $model->email . ']';
else
    $this->pageTitle = 'Менеджер пользователей: добавление';

$this->pageButton = [
    TbHtml::htmlButton(
        'Сохранить',
        [
            'icon' => TbHtml::ICON_PENCIL,
            'buttonType' => 'link',
            'url' => '#', //'/users/add',
            //            'type'=>TbHtml::BUTTON_TYPE_SUBMIT,
            'color' => TbHtml::BUTTON_COLOR_SUCCESS,
            'class'=>'btn-small',
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
            'class'=>'btn-small',
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
            'class'=>'btn-small',
            'color' => TbHtml::BUTTON_COLOR_DANGER,
        ]
    ),
];
?>
<div class="span6">
    <?php
    /**
     * @var TbActiveForm $form
     * @var UsersController $this
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
        echo $form->hiddenField($model, 'id', ['value' => $model->id]);
        echo $form->dropDownListControlGroup($model, 'group_id', ['value' => $model->group_id, 'label' => 'Группа']);
        echo $form->textFieldControlGroup($model, 'firstname', ['value' => $model->firstname, 'label' => 'Имя']);
        echo $form->textFieldControlGroup($model, 'lastname', ['value' => $model->lastname, 'label' => 'Фамилия']);
        echo $form->textFieldControlGroup($model, 'email', ['value' => $model->email, 'label' => 'Email']);
        echo $form->passwordFieldControlGroup($model, 'password', ['autocomplete'=>'off', 'value' => '', 'label' => 'Новый пароль']);
        ?>

    </fieldset>
    <input type="hidden" name="form_action" value="save">
    <?php $this->endWidget(); ?>
</div>

<?php
if(!empty($model->id))
{
?>
<div class="span6">
    <fieldset>
        <legend>Дополнительная информация</legend>
        <?php
        $this->widget(
            'yiiwheels.widgets.detail.WhDetailView',
            [
                'data' => $model,
                'attributes' => [
                    ['name' => 'id', 'label' => 'ID'],
                    ['name' => 'lognum', 'label' => 'Кол-во авторизаций'],
                    ['name' => 'logdate', 'label' => 'Последний визит'],
                    ['name' => 'modified', 'label' => 'Изменен'],
                    ['name' => 'created', 'label' => 'Создан'],
                ],
            ]
        );
        ?>
    </fieldset>
</div>
<?php
}
