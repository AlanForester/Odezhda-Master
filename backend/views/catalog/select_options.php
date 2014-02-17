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
            'strictModelUsing' => false,
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
        echo $form->dropDownListControlGroup($item, 'size', $productOptions, ['label'=>'Размер', 'value'=>'']);
        echo $form->textFieldControlGroup($item, 'quantity', ['label'=>'Количество']);
        ?>
    </fieldset>
    <?php $this->endWidget(); ?>
</div>