<?php

/**
 * This is the model class for table "{{retail_orders_products}}".
 *
 * The followings are the available columns in table '{{retail_orders_products}}':
 * @property integer $id
 */
class RetailOrdersProducts extends LegacyActiveRecord {

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
            ['retail_orders_id, products_id, quantity', 'numerical', 'integerOnly' => true, 'message'=>Yii::t('validation', 'Поле {attribute} является числовым')],
            ['name, model, quantity, price, params, products_id, retail_orders_id', 'required', 'on' => 'add, update', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
        ];
    }

    /**
     * Заголовки полей (поле=>заголовок)
     *
     * @return array
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('labels', 'ID'),
            'retail_orders_id' => Yii::t('labels', 'Розничный заказ'),
            'products_id' => Yii::t('labels', 'Товар'),
            'model' => Yii::t('labels', 'Код модели'),
            'name' => Yii::t('labels', 'Название'),
            'quantity' => Yii::t('labels', 'Количество'),
            'price' => Yii::t('labels', 'Цена (за единицу)'),
            'params' => Yii::t('labels', 'Параметры (Размер)'),
            /*'final_price' => Yii::t('labels', 'Полная цена (без налога)'),
            'products_tax' => Yii::t('labels', 'Налог'),
            'products_av' => Yii::t('labels', 'Наличие товара'),
            'products_sort' => Yii::t('labels', 'Сортировка'),*/
        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     *
     * @param string $className
     * @return RetailOrdersProducts the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
