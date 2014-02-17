<?php
Yii::import('bootstrap.widgets.TbActiveForm');

class ActiveForm extends TbActiveForm {

    /**
     * @var boolean whether to use CModel. Defaults to false.
     */
    public $strictModelUsing = true;

    /*public function init()
    {
        parent::init();
    }*/

    /**
     * Перекрытие стандартной функции.
     * Displays the first validation error for a model attribute.
     * @param CModel $model the data model
     * @param string $attribute the attribute name
     * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
     * @param boolean $enableAjaxValidation whether to enable AJAX validation for the specified attribute.
     * @param boolean $enableClientValidation whether to enable client-side validation for the specified attribute.
     * @return string the validation result (error display or success message).
     */
    public function error(
        $model,
        $attribute,
        $htmlOptions = array(),
        $enableAjaxValidation = true,
        $enableClientValidation = true
    ) {
        if (!$this->enableAjaxValidation) {
            $enableAjaxValidation = false;
        }
        if (!$this->enableClientValidation) {
            $enableClientValidation = false;
        }
        if (!$enableAjaxValidation && !$enableClientValidation) {
            return TbHtml::error($model, $attribute, $htmlOptions);
        }
        $id = CHtml::activeId($model, $attribute);
        $inputID = TbArray::getValue('inputID', $htmlOptions, $id);
        unset($htmlOptions['inputID']);
        TbArray::defaultValue('id', $inputID . '_em_', $htmlOptions);
        $option = array(
            'id' => $id,
            'inputID' => $inputID,
            'errorID' => $htmlOptions['id'],
            'model' => get_class($model),
            'name' => $attribute,
            'enableAjaxValidation' => $enableAjaxValidation,
            'inputContainer' => 'div.control-group', // Bootstrap requires this
        );
        $optionNames = array(
            'validationDelay',
            'validateOnChange',
            'validateOnType',
            'hideErrorMessage',
            'inputContainer',
            'errorCssClass',
            'successCssClass',
            'validatingCssClass',
            'beforeValidateAttribute',
            'afterValidateAttribute',
        );
        foreach ($optionNames as $name) {
            if (isset($htmlOptions[$name])) {
                $option[$name] = TbArray::popValue($name, $htmlOptions);
            }
        }
        if ($model instanceof CActiveRecord && !$model->isNewRecord) {
            $option['status'] = 1;
        }
        if ($enableClientValidation) {
            $validators = TbArray::getValue('clientValidation', $htmlOptions, array());
            $attributeName = $attribute;
            if (($pos = strrpos($attribute, ']')) !== false && $pos !== strlen($attribute) - 1) // e.g. [a]name
            {
                $attributeName = substr($attribute, $pos + 1);
            }
            foreach ($model->getValidators($attributeName) as $validator) {
                if ($validator->enableClientValidation) {
                    if (($js = $validator->clientValidateAttribute($model, $attributeName)) != '') {
                        $validators[] = $js;
                    }
                }
            }
            if ($validators !== array()) {
                $option['clientValidation'] = "js:function(value, messages, attribute) {\n" . implode(
                    "\n",
                    $validators
                ) . "\n}";
            }
        }
        //var_dump($this->strictModelUsing);exit;
        $html = $this->strictModelUsing ? TbHtml::error($model, $attribute, $htmlOptions) : '';
        if ($html === '') {
            $htmlOptions['type'] = $this->helpType;
            TbHtml::addCssStyle('display:none', $htmlOptions);
            $html = TbHtml::help('', $htmlOptions);
        }
        $this->attributes[$inputID] = $option;
        return $html;
    }

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
            'yiiwheels.widgets.datetimepicker.WhDateTimePicker',
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