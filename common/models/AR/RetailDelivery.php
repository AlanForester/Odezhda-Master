<?php

/**
 * Модель управления таблицей доставки.
 *
 * Доступные свойства:
 * @property integer id
 * @property string name
 * @property string description
 *
 */
class RetailDelivery extends LegacyActiveRecord {

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        // todo: переименовать в retail_delivery
        return 'delivery_points';
    }

    /**
     * Validation rules for model attributes.
     *
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['name', 'required', 'on' => 'add', 'message' => Yii::t('validation', 'Поле "{attribute}" является обязательным')],
            ['name', 'length', 'min'=>1, 'max'=>64, 'encoding' => 'utf-8', 'message' => Yii::t('validation', 'Длина поля {attribute} - не более 64 символов')],
            ['description', 'length', 'min'=>1, 'max'=>64, 'encoding' => 'utf-8', 'message' => Yii::t('validation', 'Длина поля {attribute} - не более 64 символов')],
            ['ordering', 'numerical', 'message' => Yii::t('validation', 'Поле "{attribute}" должно быть целым числом')],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => Yii::t('labels', 'ID'),
            'name' => Yii::t('labels', 'Название'),
            'description' => Yii::t('labels', 'Описание'),
            'ispoint' => Yii::t('labels', 'Самовывоз'),
            'ordering' => Yii::t('labels', 'Позиция'),

        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     *
     * @param string $className
     * @return RetailDelivery the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
