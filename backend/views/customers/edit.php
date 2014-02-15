<?php

$this->pageTitle = 'Менеджер клиентов: ' . ($item->id ? 'редактирование [' . $item->email . ']' : 'новый клиент');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    $from == 'retail_order' ?
        BackendPageButtons::cancelCustomer("/retail_orders/".($fromId == 0 ? 'add/' : 'edit/').$fromId, '?from=customer&fromId='.$item->id) :
        BackendPageButtons::cancelCustomer("/customers/index")
];
?>
<div class="span6">
    <?php
    /**
     * @var TbActiveForm $form
     * @var UsersController $this
     */
    $form = $this->beginWidget(
        'backend.widgets.ActiveForm',
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
        //echo $form->dateFieldControlGroup($item, 'dob', []);
        echo $form->dateTimePickerControlGroup($item, 'dob', [
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd hh:mm:ss',
                'language' => 'ru'
            ],
        ]);
        echo $form->textFieldControlGroup($item, 'email', []);
        echo $form->textFieldControlGroup($item, 'phone', []);
        echo $form->textFieldControlGroup($item, 'fax', []);
        //echo $form->dropDownListControlGroup($item, 'default_address_id', $addresses, []);
        //echo $form->dropDownListControlGroup($item, 'delivery_address_id', $addresses, []);
        //echo $form->dropDownListControlGroup($item, 'pay_address_id', $addresses, []);
        //echo $form->dropDownListControlGroup($item, 'newsletter', $newsletters, []);
        //echo $form->textFieldControlGroup($item, 'selected_template', []);
        echo $form->dropDownListControlGroup($item, 'guest_flag', $yesNo, []);
        //echo $form->dropDownListControlGroup($item, 'status', $statuses, []);
        echo $form->dropDownListControlGroup($item, 'payment_allowed', $yesNo, []);
        echo $form->dropDownListControlGroup($item, 'shipment_allowed', $yesNo, []);
        echo $form->textFieldControlGroup($item, 'referer', []);
        //echo $form->dropDownListControlGroup($item, 'default_provider', $providers, []);
        echo $form->textAreaControlGroup($item, 'comment', []);
        ?>

    </fieldset>
    <input type="hidden" name="form_action" value="save">
    <?php $this->endWidget(); ?>
</div>

<?php
if (!empty($item->id)) {
    ?>
    <div class="span6">
        <fieldset>
            <legend>Дополнительная информация</legend>
            <?php
            $this->widget(
                'yiiwheels.widgets.detail.WhDetailView',
                [
                    'data' => $item->customers_info,
                    'attributes' => [
                        ['name' => 'id'],
                        ['name' => 'logon_count'],
                        ['name' => 'last_logon'],
                        ['name' => 'modified'],
                        ['name' => 'created'],
                    ],
                ]
            );
            ?>
        </fieldset>
    </div>
<?php
}
