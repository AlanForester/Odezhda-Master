<?php
Yii::import('bootstrap.widgets.TbActiveForm');

class OMActiveForm extends TbActiveForm {

    public function datePickerControlGroup($model, $attribute, $htmlOptions = array()) {
        // the options for the Bootstrap JavaScript plugin
        $datePickerOptions = [
            'model' => $model,
            'attribute' => $attribute,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'language' => 'ru'
            ],
            /*'pluginOptions' => TbArray::popValue('pluginOptions', $htmlOptions, array()),
            'events' => TbArray::popValue('events', $htmlOptions, array()),
            'htmlOptions' => $htmlOptions,*/
        ];
        $datePicker = $this->owner->widget('yiiwheels.widgets.datepicker.WhDatePicker', $datePickerOptions, true);
        return TbHtml::customControlGroup($datePicker, $model, $attribute, $htmlOptions);
    }
}