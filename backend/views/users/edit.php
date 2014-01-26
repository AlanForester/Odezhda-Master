<?php

$this->pageTitle = 'Менеджер пользователей: ' . ($model->id ? 'редактирование [' . $model->email . ']' : 'новый пользователь');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/users/index")
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
                //'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => [
                    'validateOnSubmit' => true,
                 ]
        ]

    );?>
        <fieldset>
            <legend>Учетная запись</legend>
            <?php
            echo $form->hiddenField($model, 'id', ['value' => $model->id]);
            echo $form->dropDownListControlGroup($model, 'group_id', $groups, ['value' => $model->group_id, 'label' => 'Группа']);
            echo $form->textFieldControlGroup($model, 'firstname', ['value' => $model->firstname, 'label' => 'Имя']);
            echo $form->textFieldControlGroup($model, 'lastname', ['value' => $model->lastname, 'label' => 'Фамилия']);
            echo $form->textFieldControlGroup($model, 'email', ['value' => $model->email, 'label' => 'Email']);
            echo $form->passwordFieldControlGroup($model, 'password', ['autocomplete' => 'off', 'value' => '', 'label' => 'Новый пароль']);
            ?>

        </fieldset>
        <input type="hidden" name="form_action" value="save">
        <?php $this->endWidget(); ?>
    </div>

<?php
if (!empty($model->id)) {
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
