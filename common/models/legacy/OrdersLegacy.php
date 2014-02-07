<?php

/**
 * This is the model class for table "{{orders}}".
 */
class OrdersLegacy extends LegacyActiveRecord
{

    public $primaryKey='orders_id';

    /**
     * Name of the database table associated with this ActiveRecord
     * @return string
     */
    public function tableName()
    {
        return 'orders';
    }

    /**
     * Validation rules for model attributes.
     *
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
    public function rules() {
        return [
            ['customers_name, customers_street_address, customers_city, customers_postcode, customers_country, customers_telephone, customers_email_address, delivery_name, delivery_lastname, delivery_pasport_kogda_vidan, delivery_street_address, delivery_city, delivery_postcode, delivery_country, billing_name, billing_street_address, billing_city, billing_postcode, billing_country, payment_method, customers_fax',
                'required', 'on' => 'add, update', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
            ['customers_id, customers_groups_id, customers_address_format_id, delivery_adress_id, delivery_address_format_id, billing_address_format_id, buh_orders_id, orders_status, default_provider, seller_id', 'numerical', 'integerOnly' => true, 'message'=>Yii::t('validation', 'Поле {attribute} является числовым')],
            ['last_modified','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'update'],
            ['date_purchased, last_modified','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'add']
        ];
    }

}
