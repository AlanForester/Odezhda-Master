<?php
Yii::import('bootstrap.widgets.TbActiveForm');

class ActiveForm extends TbActiveForm {

    public function datePickerControlGroup($model, $attribute, $htmlOptions = []) {
        $datePicker = $this->owner->widget(
            'yiiwheels.widgets.datepicker.WhDatePicker',
            $this->processDateTimePickerOptions($model, $attribute, $htmlOptions),
            true
        );
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::customActiveControlGroup($datePicker, $model, $attribute, $htmlOptions);
    }

    public function dateTimePickerControlGroup($model, $attribute, $htmlOptions = []) {
        $dateTimePicker = $this->owner->widget(
            //'yiiwheels.widgets.datetimepicker.WhDateTimePicker',
            'backend.widgets.DateTimePicker',    //исправление подгрузки рус.языка
            $this->processDateTimePickerOptions($model, $attribute, $htmlOptions),
            true
        );
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::customActiveControlGroup($dateTimePicker, $model, $attribute, $htmlOptions);
    }

    private function processDateTimePickerOptions($model, $attribute, &$htmlOptions = []) {
        return [
            'model' => $model,
            'attribute' => $attribute,
            'pluginOptions' => TbArray::popValue('pluginOptions', $htmlOptions, []),
            'events' => TbArray::popValue('events', $htmlOptions, []),
            'htmlOptions' => $htmlOptions,
        ];
    }
}