<?php

$this->pageTitle = 'Менеджер размеров: ' . ($item->id ? 'редактирование [' . $item->name . ']' : 'новый размер');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/size/index")
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
            <legend>Основные данные</legend>
            <?php
            $selectOldOptions=[];
            foreach($item->products_option_values as $elem){
                $selectOldOptions[$elem->products_options_values_id]=['selected'=>'selected'];
            }

            echo $form->hiddenField($item, 'id', []);
            echo $form->textFieldControlGroup($item, 'name', []);
            $mod = (empty($item->rel_old_id)?:  null);
            echo $form->dropDownListControlGroup($item,'products_to_new_options', $oldOptionList,[
                'options' =>$selectOldOptions,
                'multiple'=>'multiple',
                'size'=>'10',
                'label' => 'Категории',
                'style' => 'width:100%;'
            ]);
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
                    'data' => $item,
                    'attributes' => [
                        ['name' => 'id']
                    ],
                ]
            );
            ?>
        </fieldset>
    </div>
<?php
}
