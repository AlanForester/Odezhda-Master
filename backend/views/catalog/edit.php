<?php

$this->pageTitle = 'Управление товарами: ' . ($model->id ? 'редактирование' : 'создать товар');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/catalog/index")
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
            <legend>Товар</legend>
            <?php
            echo $form->hiddenField($model, 'id', ['value' => $model->id]);
            echo $form->textFieldControlGroup($model, 'name', ['value' => $model->name, 'label' => 'Название']);
            echo $form->textFieldControlGroup($model, 'description', ['value' => $model->description, 'label' => 'Описание']);
            echo $form->textFieldControlGroup($model, 'model', ['value' => $model->model, 'label' => 'Код товара']);
            echo '<br/>';
            echo $form->textFieldControlGroup($model, 'quantity', ['value' => $model->quantity, 'label' => 'Количество']);
            echo $form->textFieldControlGroup($model, 'weight', ['value' => $model->weight, 'label' => 'Вес']);
            echo '<br/>';
            echo $form->textFieldControlGroup($model, 'price', ['value' => $model->price, 'label' => 'Цена, руб.']);
            echo $form->textFieldControlGroup($model, 'old_price', ['value' => $model->old_price, 'label' => 'Старая цена, руб.']);
            echo '<br/>';

            echo $form->textFieldControlGroup($model, 'min_quantity', ['value' => $model->min_quantity, 'label' => 'Минимальный заказ']);
            echo $form->textFieldControlGroup($model, 'step', ['value' => $model->step, 'label' => 'Шаг заказа']);
            echo '<br/>';

            //сделать checkbox
            echo $form->textFieldControlGroup($model, 'status', ['value' => $model->status, 'label' => 'Наличие','type'=>'primary']);
            echo $form->textFieldControlGroup($model, 'xml', ['value' => $model->xml, 'label' => 'XML' ]);
            echo '<br/>';



            echo $form->textFieldControlGroup($model, 'order', ['value' => $model->order, 'label' => 'Порядок сортировки']);


                echo $form->dropDownListControlGroup($model,'category', $this->categories,[
                'options' =>$catalog['categories_id'],
                'multiple'=>'multiple',
                'size'=>'10',
                'label' => 'Категории',

            ])
            ?>

        </fieldset>
        <input type="hidden" name="form_action" value="save">

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
                        ['name' => 'date_add', 'label' => 'Дата создания'],
                        ['name' => 'date_last', 'label' => 'Дата изменения'],

                    ],
                ]
            );
            ?>
        </fieldset>
        <fieldset>
            <legend>Метаданные</legend>
            <?php
            echo $form->textFieldControlGroup($model, 'meta_title', ['value' => $model->meta_title,'label' => 'Title']);
            //            echo $form->textFieldControlGroup($model, 'meta_description', ['value' => $model->meta_description, 'label' => 'Description']);
            //            echo $form->textFieldControlGroup($model, 'meta_keywords', ['value' => $model->meta_keywords, 'label' => 'Keywords']);

            echo $form->textAreaControlGroup($model, 'meta_description', ['value' => $model->meta_description,'label' => 'Description', 'span' => 8, 'rows' => 5]);
            echo $form->textAreaControlGroup($model, 'meta_keywords', ['value' => $model->meta_keywords,'label' => 'Keywords', 'span' => 8, 'rows' => 5]);
            ?>
        </fieldset>
    </div>
<?php  $this->endWidget();
}

