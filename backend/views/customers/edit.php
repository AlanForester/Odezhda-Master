<?php

$this->pageTitle = 'Менеджер покупателей: ' . ($item->id ? 'редактирование [' . $item->email . ']' : 'новый покупатель');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/customers/index")
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
        echo $form->hiddenField($item, 'id', []);
        echo $form->dropDownListControlGroup($item, 'group_id', $groups, []);
        echo $form->textFieldControlGroup($item, 'firstname', []);
        echo $form->textFieldControlGroup($item, 'lastname', []);
        echo $form->textFieldControlGroup($item, 'email', []);
        echo $form->passwordFieldControlGroup($item, 'password', ['autocomplete' => 'off', 'value' => '']);
        ?>

    </fieldset>
    <input type="hidden" name="form_action" value="save">
    <?php $this->endWidget(); ?>
</div>