<?php

$this->pageTitle = 'Менеджер баннеров: ' . ($item->id ? 'редактирование [' . $item->name . ']' : 'новый баннер');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/retail_banners/index")
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
            echo $form->hiddenField($item, 'id', []);
            echo $form->textFieldControlGroup($item, 'name', []);
            echo $form->textFieldControlGroup($item, 'url', []);
            echo $form->textFieldControlGroup($item, 'images', []);
            echo $form->textAreaControlGroup($item, 'description', []);
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
