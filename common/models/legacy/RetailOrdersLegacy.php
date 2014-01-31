<?php

/**
 * This is the model class for table "{{retail_orders}}".
 *
 * The followings are the available columns in table '{{retail_orders}}':
 * @property integer $retail_orders_id
 */
class UserLegacy extends CActiveRecord {

    public $primaryKey = 'retail_orders_id';

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        return 'retail_orders';
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
            ['orders_id, customer_id, delivery_points_id', 'numerical', 'integerOnly' => true, 'message'=>Yii::t('validation', 'Поле {attribute} должно быть числовым')],
            ['customer_id', 'required', 'on' => 'add', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
            //['address_id, delivery_address_id, billing_address_id', 'required', 'on' => 'add', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
            ['customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state`, customers_country, customers_telephone, customers_email_address, delivery_name, delivery_lastname, delivery_pasport_kogda_vidan, delivery_street_address, delivery_city, delivery_postcode, delivery_country, billing_name, billing_street_address, billing_city, billing_postcode, billing_country, payment_method, customers_fax',
                'required', 'on' => 'add', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
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
