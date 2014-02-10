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
        echo $form->textFieldControlGroup($item, 'middlename', []);
        echo $form->textFieldControlGroup($item, 'lastname', []);
        echo $form->passwordFieldControlGroup($item, 'password', ['autocomplete' => 'off', 'value' => '']);
        echo $form->dropDownListControlGroup($item, 'gender', $genders, []);
        echo $form->dateFieldControlGroup($item, 'dob', []);
        echo $form->textFieldControlGroup($item, 'email', []);
        echo $form->textFieldControlGroup($item, 'phone', []);
        echo $form->textFieldControlGroup($item, 'fax', []);
        //echo $form->dropDownListControlGroup($item, 'default_address_id', $addresses, []);
        //echo $form->dropDownListControlGroup($item, 'delivery_address_id', $addresses, []);
        //echo $form->dropDownListControlGroup($item, 'pay_address_id', $addresses, []);
        //echo $form->dropDownListControlGroup($item, 'newsletter', $newsletters, []);
        //echo $form->textFieldControlGroup($item, 'selected_template', []);
        echo $form->dropDownListControlGroup($item, 'guest_flag', $guestFlags, []);
        //echo $form->dropDownListControlGroup($item, 'status', $statuses, []);
        echo $form->textFieldControlGroup($item, 'payment_allowed', []);
        echo $form->textFieldControlGroup($item, 'shipment_allowed', []);
        echo $form->textFieldControlGroup($item, 'referer', []);
        //echo $form->dropDownListControlGroup($item, 'default_provider', $providers, []);
        echo $form->textFieldControlGroup($item, 'comment', []);
        ?>

    </fieldset>
    <input type="hidden" name="form_action" value="save">
    <?php $this->endWidget(); ?>
</div>