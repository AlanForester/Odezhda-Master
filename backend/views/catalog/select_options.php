<div class="span12">
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
        //$item = null;
        echo $form->dropDownListControlGroup($product, 'size', $productOptions, ['label'=>'Размер', 'value'=>'']);
        echo $form->numberFieldControlGroup($product, 'quantity', ['label'=>'Количество', 'value'=>'1']);
        ?>
    </fieldset>
    <?php $this->endWidget(); ?>
</div>