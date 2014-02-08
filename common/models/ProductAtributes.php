<?php

class ProductAtributes extends LegacyActiveRecord {


    public function tableName() {
        return 'products_attributes';
    }


    public function getRules() {
        return [
//            ['language_id', 'numerical', 'integerOnly' => true, 'message' => Yii::t('validation', 'Поле должно быть числовым')],
//            ['language_id', 'exist', 'allowEmpty' => false, 'className' => 'Language', 'attributeName' => 'languages_id', 'message' => Yii::t('validation', 'Неверное значение для поля')],
//            ['name', 'required', 'message' => Yii::t('validation', 'Название является обязательным')],
//            ['description', 'required', 'message' => Yii::t('validation', 'Описание является обязательным')],
        ];
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
