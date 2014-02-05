<?php

$this->pageTitle = 'Информационная страница: ' . ($item->id ? 'редактирование [' . $item->name . ']' : 'новый пользователь');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/info_pages/index")
];
?>
    <div class="span7">
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
            echo $form->textFieldControlGroup($item, 'name', []);
            echo $form->textAreaControlGroup($item, 'description', ['span' => 10, 'rows' => 20]);
//            $this->widget('yiiwheels.widgets.redactor.WhRedactor', [
//                'name' => 'redactortest',
//                'model' => $item,
//                'attribute' => 'description',
//                'htmlOptions' => [
////                    'style' => 'margin-bottom: 20px',
//                ],
//
//            ]);
            echo $form->dropDownListControlGroup($item, 'language_id', $languages, []);
            echo $form->dropDownListControlGroup($item, 'status', [1 => "Да", 0 => "Нет"], ['label' => 'Опубликовано']);
            echo $form->textFieldControlGroup($item, 'sort_order', []);
            ?>

        </fieldset>
        <input type="hidden" name="form_action" value="save">
        <?php $this->endWidget(); ?>
    </div>

<?php
if (!empty($item->id)) {
    ?>
    <div class="span5">
        <fieldset>
            <legend>Дополнительная информация</legend>
            <?php
            $this->widget(
                'yiiwheels.widgets.detail.WhDetailView',
                [
                    'data' => $item,
                    'attributes' => [
                        ['name' => 'id'],
                        ['name' => 'viewed'],
                        ['name' => 'modified'],
                        ['name' => 'added'],
                    ],
                ]
            );
            ?>
        </fieldset>
    </div>
<?php
}
