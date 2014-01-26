<?php

$this->pageTitle = 'Менеджер категорий: ' . ($model->id ? 'редактирование [' . $model->name . ']' : 'новая категория');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/categories/index")
];

/**
 * @var TbActiveForm $form
 * @var UsersController $this
 */
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        //'enableAjaxValidation' => true,
//        'enableClientValidation' => true,
//        'clientOptions' => [
//            'validateOnSubmit' => true,
//        ]
    ]

);

?>
    <div class="span6">

        <fieldset>
            <legend>Категория</legend>
            <?php

            echo $form->hiddenField($model, 'id', ['value' => $model->id]);
            //echo $form->dropDownListControlGroup($model, 'parent_id', $groups, ['value' => $model->parent_id, 'label' => 'Родительская категория']);
            echo $form->dropDownListControlGroup($model, 'parent_id', [], ['value' => $model->parent_id, 'label' => 'Родительская категория']);
            echo $form->textFieldControlGroup($model, 'name', ['label' => 'Название']);
            echo $form->textFieldControlGroup($model, 'heading_title', ['value' => $model->heading_title, 'label' => 'Заголовок']);

            echo $form->textFieldControlGroup($model, 'image', ['value' => $model->image, 'label' => 'Изображение']);
            echo $form->textFieldControlGroup($model, 'language_id', ['value' => $model->language_id, 'label' => 'Язык']);

            echo $form->dropDownListControlGroup($model, 'status', [1 => "Да", 0 => "Нет"], ['label' => 'Статус']);
            echo $form->dropDownListControlGroup($model, 'xml_flag', [1 => "Да", 0 => "Нет"], ['value' => $model->xml_flag, 'label' => 'XML флаг']);
            echo $form->textFieldControlGroup($model, 'markup', ['value' => $model->markup, 'label' => 'Markup']);

            echo $form->textAreaControlGroup($model, 'description', ['label' => 'Описание категории', 'span' => 8, 'rows' => 5]);
            ?>

        </fieldset>
        <input type="hidden" name="form_action" value="save">

    </div>


    <div class="span6">
        <?php
        if (!empty($model->id)) {
            ?>
            <fieldset>
                <legend>Дополнительная информация</legend>
                <?php
                $this->widget(
                    'yiiwheels.widgets.detail.WhDetailView',
                    [
                        'data' => $model,
                        'attributes' => [
                            ['name' => 'id', 'label' => 'ID'],
                            ['name' => 'added', 'label' => 'Создан'],
                            ['name' => 'modified', 'label' => 'Изменен'],

                        ],
                    ]
                );
                ?>
            </fieldset>
        <?php
        }
        ?>

        <fieldset>
            <legend>Метаданные</legend>
            <?php
            echo $form->textFieldControlGroup($model, 'meta_title', ['label' => 'Ttitle']);
//            echo $form->textFieldControlGroup($model, 'meta_description', ['value' => $model->meta_description, 'label' => 'Description']);
//            echo $form->textFieldControlGroup($model, 'meta_keywords', ['value' => $model->meta_keywords, 'label' => 'Keywords']);

            echo $form->textAreaControlGroup($model, 'meta_description', ['label' => 'Description', 'span' => 8, 'rows' => 5]);
            echo $form->textAreaControlGroup($model, 'meta_keywords', ['label' => 'Keywords', 'span' => 8, 'rows' => 5]);
            ?>
        </fieldset>
    </div>
<?php
$this->endWidget();