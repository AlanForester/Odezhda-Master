<?php

/**
 * Модель управления таблицей оптовых заказов.
 */
class Orders extends LegacyActiveRecord {

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        return 'orders';
    }

//    public function relations()
//    {
//        return [
//            'provider_name' => [self::BELONGS_TO, 'AdminCompanies', 'default_provider', 'together' => true]
//        ];
//    }

    public function fieldMap() {
        return [
            'orders_id' => 'id',
            'ur_or_fiz' => 'person_type',
            'customers_id' => 'customers_id',
            'customers_name' => 'customers_name',
            /*'customers_groups_id' => 'customers_groups_id',
            'customers_company' => 'customers_company',
            'customers_street_address' => 'customers_street_address',
            'customers_suburb' => 'customers_suburb',
            'customers_city' => 'customers_city',
            'customers_postcode' => 'customers_postcode',
            'customers_state' => 'customers_state',
            'customers_country' => 'customers_country',
            'customers_telephone' => 'customers_telephone',
            'customers_email_address' => 'customers_email_address',
            'customers_address_format_id' => 'customers_address_format_id',*/
            'delivery_adress_id' => 'delivery_address_id',
            /*'delivery_name' => 'delivery_name',
            'delivery_lastname' => 'delivery_lastname',*/
            'delivery_otchestvo' => 'delivery_middlename',
            'delivery_pasport_seria' => 'delivery_passport_serie',
            'delivery_pasport_nomer' => 'delivery_passport_number',
            'delivery_pasport_kem_vidan' => 'delivery_passport_issue_organization',
            'delivery_pasport_kogda_vidan' => 'delivery_passport_issue_date',
            'delivery_company' => 'delivery_company',
            'delivery_street_address' => 'delivery_street_address',
            /*'delivery_suburb' => 'delivery_suburb',
            'delivery_city' => 'delivery_city',
            'delivery_postcode' => 'delivery_postcode',
            'delivery_state' => 'delivery_state',
            'delivery_country' => 'delivery_country',
            'delivery_address_format_id' => 'delivery_address_format_id',
            'billing_name' => 'billing_name',
            'billing_company' => 'billing_company',
            'billing_street_address' => 'billing_street_address',
            'billing_suburb' => 'billing_suburb',
            'billing_city' => 'billing_city',
            'billing_postcode' => 'billing_postcode',
            'billing_state' => 'billing_state',
            'billing_country' => 'billing_country',
            'billing_address_format_id' => 'billing_address_format_id',
            'payment_method' => 'payment_method',
            'payment_info' => 'payment_info',
            'cc_type' => 'cc_type',
            'cc_owner' => 'cc_owner',
            'cc_number' => 'cc_number',
            'cc_expires' => 'cc_expires',
            'last_modified' => 'last_modified',*/
            'date_purchased' => 'date_purchased',
            'date_akt' => 'act_date',
            'buh_orders_id' => 'booker_orders_id',
            'nomer_akt' => 'act_number',
            'orders_status' => 'orders_status_id',
          /*'orders_date_finished' => 'orders_date_finished',
            'currency' => 'currency',
            'currency_value' => 'currency_value',
            'customers_fax' => 'customers_fax',
            'customers_referer_url' => 'customers_referer_url',
            'shipping_module' => 'shipping_module',
            'referer' => 'referer',
            'print_torg' => 'print_torg',    //? */
            'default_provider' => 'default_provider_id',
            /*'seller_id' => 'seller_id',
            'orders_discont' => 'orders_discont',
            'orders_discont_comment' => 'orders_discont_comment',*/
        ];
    }
    public  function total_price($id){
        $total_price = Yii::app()->db->createCommand()
            ->select('sum( `final_price` * `products_quantity` )')
            ->from('orders_products op')
            ->join('orders o', 'op.orders_id=o.user_id')
            ->where('orders_id', array(':id'=>$id))
            ->queryRow();
        return $total_price;
    }
    /**
     * Правила проверки полей модели
     *
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
    public function getRules() {
        return [
            ['customers_name, customers_street_address, customers_city, customers_postcode, customers_country, customers_telephone, customers_email_address, delivery_name, delivery_lastname, delivery_pasport_kogda_vidan, delivery_street_address, delivery_city, delivery_postcode, delivery_country, billing_name, billing_street_address, billing_city, billing_postcode, billing_country, payment_method, customers_fax',
                'required', 'on' => 'add, update', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
            ['customers_id, customers_groups_id, customers_address_format_id, delivery_adress_id, delivery_address_format_id, billing_address_format_id, buh_orders_id, orders_status, seller_id', 'numerical', 'integerOnly' => true, 'message'=>Yii::t('validation', 'Поле {attribute} является числовым')],
            ['last_modified','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'update'],
            ['date_purchased, last_modified','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'add'],
            ['orders_status_id', 'required', 'message' => Yii::t('validation', 'Статус является обязательной')],
            ['default_provider', 'required', 'message' => Yii::t('validation', 'Выберите поставщика')],
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
            'customers_name' => Yii::t('labels', 'Имя'),
            'orders_status_id' => Yii::t('labels', 'Статус'),
            'date_purchased' => Yii::t('labels', 'Дата покупки'),
            'default_provider' => Yii::t('labels', 'Поставщик'),
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
