<?php
Yii::import('bootstrap.widgets.TbActiveForm');

class ActiveForm extends TbActiveForm {

    public function datePickerControlGroup($model, $attribute, $htmlOptions = []) {
        $datePickerOptions = [
            'model' => $model,
            'attribute' => $attribute,
            'pluginOptions' => TbArray::popValue('pluginOptions', $htmlOptions, []),
            'events' => TbArray::popValue('events', $htmlOptions, []),
            'htmlOptions' => $htmlOptions,
        ];
        $datePicker = $this->owner->widget(
            'yiiwheels.widgets.datepicker.WhDatePicker',
            $datePickerOptions,
            true
        );
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::customActiveControlGroup($datePicker, $model, $attribute, $htmlOptions);
    }
}