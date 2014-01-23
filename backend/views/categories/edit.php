<?php

$this->pageTitle = 'Менеджер категорий: ' . ($model->id ? 'редактирование [' . $model->name . ']' : 'новая категория');

$this->pageButton = [
    TbHtml::htmlButton(
        'Сохранить',
        [
            'icon' => TbHtml::ICON_PENCIL,
            'buttonType' => 'link',
            'url' => '#', //'/users/add',
            //            'type'=>TbHtml::BUTTON_TYPE_SUBMIT,
            'color' => TbHtml::BUTTON_COLOR_SUCCESS,
            'class' => 'btn-small',
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
            'class' => 'btn-small',
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
            'class' => 'btn-small',
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
                //'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => [
                    'validateOnSubmit' => true,
//                    'afterValidate' => 'js: function(form,data,hasError)
//                                        {
//                                            if(!hasError)
//                                            {
//                                                $.ajax(
//                                                {
//                                                    "type":"POST",
//                                                    "url":"' . CHtml::normalizeUrl(array("site/subscribe")) . '",
//                                                    "data":form.serialize(),
//                                                    "success":function(data)
//                                                    {
//                                                        $("#success").html("Вы подписаны на обновления.");
//                                                    },
//                                                });
//                                            }
//                                        }'
                 ]
        ]

    );?>
        <fieldset>
            <legend>Категория</legend>
            <?php

//            CVarDumper::dump($model);
            echo $form->hiddenField($model, 'id', ['value' => $model->id]);
            //echo $form->dropDownListControlGroup($model, 'parent_id', $groups, ['value' => $model->parent_id, 'label' => 'Родительская категория']);
            echo $form->dropDownListControlGroup($model, 'parent_id', [], ['value' => $model->parent_id, 'label' => 'Родительская категория']);
            echo $form->textFieldControlGroup($model, 'name', [ 'label' => 'Название']);
            echo $form->textFieldControlGroup($model, 'image', ['value' => $model->image, 'label' => 'Изображение']);
            echo $form->textFieldControlGroup($model, 'language_id', ['value' => $model->language_id, 'label' => 'Язык']);
            echo $form->textAreaControlGroup($model, 'description', ['label' => 'Описание категории','span' => 8, 'rows' => 5]);
            echo $form->textFieldControlGroup($model, 'heading_title', ['value' => $model->heading_title, 'label' => 'Title']);
            echo $form->textFieldControlGroup($model, 'meta_title', ['value' => $model->meta_title, 'label' => 'Meta title']);
            echo $form->textFieldControlGroup($model, 'meta_description', ['value' => $model->meta_description, 'label' => 'Meta description']);
            echo $form->textFieldControlGroup($model, 'meta_keywords', ['value' => $model->meta_keywords, 'label' => 'Meta keywords']);
            echo $form->dropDownListControlGroup($model, 'status', [1=>"Да", 0=>"Нет"], [ 'label' => 'Статус']);
            echo $form->dropDownListControlGroup($model, 'xml_flag', [1=>"Да", 0=>"Нет"], ['value' => $model->xml_flag, 'label' => 'XML флаг']);
            echo $form->textFieldControlGroup($model, 'markup', ['value' => $model->markup, 'label' => 'Markup']);
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
                        ['name' => 'added', 'label' => 'Создан'],
                        ['name' => 'modified', 'label' => 'Изменен'],

                    ],
                ]
            );
            ?>
        </fieldset>
    </div>
<?php
}
