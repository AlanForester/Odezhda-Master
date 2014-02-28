<?php

$this->pageTitle = 'Управление товарами: ' . ($item->id ? 'редактирование' : 'создать товар');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/product/index")
];
//print_r($item);exit;
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
                'htmlOptions'=>array('enctype'=>'multipart/form-data'),
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
            echo $form->hiddenField($model, 'id', ['value' => $item->id]);
            echo $form->textFieldControlGroup($model, 'name', ['value' => $item->name, 'label' => 'Название *']);
            echo $form->textAreaControlGroup($model, 'description', ['value' => $item->description, 'label' => 'Описание']);
            echo $form->textFieldControlGroup($model, 'model', ['value' => $item->model?:0, 'label' => 'Код товара']);
            echo '<br/>';
            echo $form->textFieldControlGroup($model, 'quantity', ['value' => $item->quantity?:0, 'label' => 'Количество']);
            echo $form->textFieldControlGroup($model, 'weight', ['value' => $item->weight?:0, 'label' => 'Вес']);
            echo '<br/>';
            echo $form->textFieldControlGroup($model, 'price', ['value' => $item->price?:0, 'label' => 'Цена, руб.']);
            echo $form->textFieldControlGroup($model, 'old_price', ['value' => $item->old_price?:0, 'label' => 'Старая цена, руб.']);
//            echo $form->dropDownListControlGroup($model, 'status', [1 => "НДС", 0 => "Нет"], ['label' => 'Налог']);
            echo '<br/>';

//            echo $form->textFieldControlGroup($model, 'min_quantity', ['value' => $item->min_quantity, 'label' => 'Минимальный заказ']);
//            echo $form->textFieldControlGroup($model, 'step', ['value' => $item->step, 'label' => 'Шаг заказа']);
            echo '<br/>';

            //сделать checkbox
//            echo $form->dropDownListControlGroup($model, 'status', [1 => "Да", 0 => "Нет"], ['label' => 'Статус']);
//            echo $form->dropDownListControlGroup($model, 'xml', [1 => "Да", 0 => "Нет"], ['value' => $item->xml, 'label' => 'XML флаг']);
//            echo $form->textFieldControlGroup($model, 'status', ['value' => $model->status, 'label' => 'Наличие','type'=>'primary']);
//            echo $form->textFieldControlGroup($model, 'xml', ['value' => $model->xml, 'label' => 'XML' ]);
            echo '<br/>';



//            echo $form->textFieldControlGroup($model, 'order', ['value' => $item->order, 'label' => 'Порядок сортировки']);


//            echo $form->dropDownListControlGroup($model, 'languages_id',  $this->languages_list, ['label' => 'Язык']);
//            echo $form->dropDownListControlGroup($model, 'manufacturers_id',  $this->manufacturers_list, ['label' => 'Производитель']);
//            echo $form->dropDownListControlGroup($model,'category', $this->categories,[
//                'options' =>$catalog['categories_id'],
//                'multiple'=>'multiple',
//                'size'=>'10',
//                'label' => 'Категории',
//
//            ])
            ?>

        </fieldset>
        <input type="hidden" name="form_action" value="save">

    </div>
    <div class="span6 form-horizontal">
<?php
if (!empty($item->id)) {
    ?>

        <fieldset>
            <legend>Дополнительная информация</legend>
            <?php
            $this->widget(
                'yiiwheels.widgets.detail.WhDetailView',
                [
                    'data' => $item,
                    'attributes' => [
                        ['name' => 'id', 'label' => 'ID'],
                        ['name' => 'date_add', 'label' => 'Дата создания'],
                        ['name' => 'date_last', 'label' => 'Дата изменения'],
                        ['name' => 'count_orders', 'label' => 'Покупок']

                    ],
                ]
            );
            ?>
        </fieldset>

<?php } ?>
    <fieldset>
        <legend>Метаданные</legend>
        <?php
//        echo $form->textFieldControlGroup($model, 'meta_title', ['value' => $item->meta_title,'label' => 'Title', 'span' => 8]);
//        echo $form->textAreaControlGroup($model, 'meta_description', ['value' => $item->meta_description,'label' => 'Description', 'span' => 8, 'rows' => 5]);
//        echo $form->textAreaControlGroup($model, 'meta_keywords', ['value' => $item->meta_keywords,'label' => 'Keywords', 'span' => 8, 'rows' => 5]);
        ?>
    </fieldset>

        <fieldset>
            <legend>Фотографии</legend>
            <?php
          echo $form->fileFieldControlGroup($model, 'image', ['accept'=>'image/*','value' => $item->image,'url'=>'file/index','label' => 'Фото', 'span' => 8]);


     /*            $this->widget(
                        'yiiwheels.widgets.fileupload.WhFileUpload',
                        array(
                            'name'     => 'image',
                            'url'      => $this->createUrl('file/index', array('fine' => '1')),
                            'multiple' => true,
                        )
                    );*/

//            $this->widget('yiiwheels.widgets.fineuploader.WhFineUploader', array(
//                'name'          => 'image',
//                'uploadAction'  => $this->createUrl('catalog/edit/'),
//                'pluginOptions' => array(
//                    'validation'=>array(
//                        'allowedExtensions' => array( 'jpg')
//                    ),
//                    'autoUpload' => false
//                )
//            ));
            if(!empty($model->image)){
            $this->widget(
                            'yiiwheels.widgets.detail.WhDetailView',
                            [
                                'data' => $model,
                                'attributes' => [
                                    ['name' => 'image', 'label' => 'Название фото']
                                ],
                            ]
                        );
                echo '<img src="'.Yii::app()->request->baseUrl.'/images/catalog/'.$model->image.'" class="img">';
            }
            ?>

        </fieldset>



    </div>
<?php  $this->endWidget();

