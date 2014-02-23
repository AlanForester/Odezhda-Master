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
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'clientOptions' => [
                'validateOnSubmit' => false,
            ]
        ]

    );
    ?>
    <fieldset>
        <?php
        echo $form->dropDownListControlGroup($product, 'params[size]', $productOptions, ['label'=>'Размер', 'value'=>'']);
        //echo $form->dropDownListControlGroup($product, 'params[color]', $colorOptions, ['label'=>'Цвет', 'value'=>'']);
        echo $form->numberFieldControlGroup($product, 'quantity', ['label'=>'Количество', 'value'=>'1']);
        ?>
    </fieldset>
    <?php $this->endWidget(); ?>
</div>