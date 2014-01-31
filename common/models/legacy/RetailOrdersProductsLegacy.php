<?php

/**
 * This is the model class for table "{{retail_orders_products}}".
 *
 * The followings are the available columns in table '{{retail_orders_products}}':
 * @property integer $retail_orders_products_id
 */
class RetailOrdersProductsLegacy extends CActiveRecord {

    public $primaryKey = 'retail_orders_products_id';

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        return 'retail_orders_products';
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
            ['retail_orders_id, products_id', 'numerical', 'integerOnly' => true, 'message'=>Yii::t('validation', 'Поле {attribute} должно быть числовым')],
            ['retail_orders_id, products_id, products_name', 'required', 'on' => 'add', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
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
