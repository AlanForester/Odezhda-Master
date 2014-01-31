<?php

/**
 * This is the model class for table "{{retail_orders_statuses}}".
 *
 * The followings are the available columns in table '{{retail_orders_statuses}}':
 * @property integer $id
 */
class RetailOrdersStatuses extends CActiveRecord {

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        return 'retail_orders_statuses';
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
        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     *
     * @param string $className
     * @return RetailOrdersStatuses the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
