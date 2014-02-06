<?php

$this->pageTitle = 'Информационная страница: ' . ($item->id ? 'редактирование [' . $item->name . ']' : 'новый пользователь');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/info_pages/index")
];
?>

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
    <div class="span7">
        <fieldset>
            <legend>Учетная запись</legend>
            <?php
            echo $form->textFieldControlGroup($item, 'name', []);
//            echo $form->textAreaControlGroup($item, 'description', ['span' => 10, 'rows' => 20]);
            echo $form->dropDownListControlGroup($item, 'language_id', $languages, []);
            echo $form->dropDownListControlGroup($item, 'status', [1 => "Да", 0 => "Нет"], ['label' => 'Опубликовано']);
            echo $form->textFieldControlGroup($item, 'sort_order', []);
            ?>

        </fieldset>
        <input type="hidden" name="form_action" value="save">
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
?>
<div class="row-fluid">
    <div class="span12">
        <fieldset>
            <?php
            $this->widget('yiiwheels.widgets.redactor.WhRedactor', [
                'name' => 'InfoPage[description]',
                'model' => $item,
//                'head'=>'123',
                'attribute' => 'description',
                'pluginOptions'=>[
//                    'iframe'=>'true',
                ],
                'htmlOptions' => [
//                    'label'=>'123'
//                    'width'=>'10px',
//                    'style' => 'margin-bottom: 20px',
                ],

            ]);
            ?>
     </fieldset>
</div>
</div>
<br><br>
<?php $this->endWidget(); ?>