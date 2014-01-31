<?php

/**
 * This is the model class for table "{{delivery_points}}".
 *
 * The followings are the available columns in table '{{delivery_points}}':
 * @property integer $delivery_points_id
 */
class RetailOrdersProductsLegacy extends CActiveRecord {

    public $primaryKey = 'delivery_points_id';

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
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
            ['name', 'required', 'on' => 'add', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
            ['name', 'length', 'min'=>1, 'max'=>64, 'encoding' => 'utf-8', 'message' => Yii::t('validation', 'Длина поля {attribute} - не более 64 символов')],
            ['description', 'length', 'min'=>0, 'max'=>128, 'encoding' => 'utf-8', 'message' => Yii::t('validation', 'Длина поля {attribute} - не более 128 символов')],
        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     *
     * @param string $className
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
