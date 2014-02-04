<?php

/**
 * This is the model class for table "{{retail_orders}}".
 *
 * The followings are the available columns in table '{{retail_orders}}':
 * @property integer $id
 */
class RetailOrders extends LegacyActiveRecord {

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
            ['customers_name, customers_company, customers_city, customers_telephone', 'required', 'on' => 'update', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
            ['orders_id, customers_id, delivery_points_id, retail_orders_statuses_id', 'numerical', 'integerOnly' => true, 'message'=>Yii::t('validation', 'Поле {attribute} является числовым')],
            ['customers_id', 'required', 'on' => 'add', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
            //['address_id, delivery_address_id, billing_address_id', 'required', 'on' => 'add', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
            ['person_type, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state`, customers_country, customers_telephone, customers_email_address, delivery_name, delivery_lastname, delivery_pasport_kogda_vidan, delivery_street_address, delivery_city, delivery_postcode, delivery_country, billing_name, billing_street_address, billing_city, billing_postcode, billing_country, payment_method, customers_fax',
                'required', 'on' => 'add', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
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
            'orders_id' => Yii::t('labels', 'Оптовый заказ'),
            'delivery_points_id' => Yii::t('labels', 'Точка доставки'),
            'retail_orders_statuses_id' => Yii::t('labels', 'Статус'),
            'customers_name' => Yii::t('labels', 'Имя покупателя'),
            'customers_company' => Yii::t('labels', 'Компания покупателя'),
            'customers_street_address' => Yii::t('labels', 'Адрес покупателя'),
            'customers_suburb' => Yii::t('labels', 'Район города покупателя'),
            'customers_city' => Yii::t('labels', 'Город покупателя'),
            'customers_postcode' => Yii::t('labels', 'Почтовый индекс покупателя'),
            'customers_state' => Yii::t('labels', 'Регион покупателя'),
            'customers_country' => Yii::t('labels', 'Страна покупателя'),
            'customers_telephone' => Yii::t('labels', 'Телефон покупателя'),
            'customers_email_address' => Yii::t('labels', 'E-mail покупателя'),
            'delivery_name' => Yii::t('labels', 'Имя (для доставки)'),
            'delivery_middlename' => Yii::t('labels', 'Отчество (для доставки)'),
            'delivery_lastname' => Yii::t('labels', 'Фамилия (для доставки)'),
            'delivery_company' => Yii::t('labels', 'Компания (для доставки)'),
            'delivery_street_address' => Yii::t('labels', 'Адрес (для доставки)'),
            'delivery_suburb' => Yii::t('labels', 'Район города (для доставки)'),
            'delivery_city' => Yii::t('labels', 'Город (для доставки)'),
            'delivery_postcode' => Yii::t('labels', 'Почтовый индекс (для доставки)'),
            'delivery_state' => Yii::t('labels', 'Регион (для доставки)'),
            'delivery_country' => Yii::t('labels', 'Страна доставки'),
            'billing_name' => Yii::t('labels', 'Имя (для оплаты)'),
            'billing_company' => Yii::t('labels', 'Компания (для оплаты)'),
            'billing_street_address' => Yii::t('labels', 'Адрес (для оплаты)'),
            'billing_suburb' => Yii::t('labels', 'Район города (для оплаты)'),
            'billing_city' => Yii::t('labels', 'Город (для оплаты)'),
            'billing_postcode' => Yii::t('labels', 'Почтовый индекс (для оплаты)'),
            'billing_state' => Yii::t('labels', 'Регион (для оплаты)'),
            'billing_country' => Yii::t('labels', 'Страна (для оплаты)'),
            'payment_method' => Yii::t('labels', 'Метод оплаты'),
            'payment_info' => Yii::t('labels', 'Информация об оплате'),
            'date_purchased' => Yii::t('labels', 'Дата создания'),
            'currency' => Yii::t('labels', 'Валюта'),
            'currency_value' => Yii::t('labels', 'Значение валюты'),
            'default_provider' => Yii::t('labels', 'Поставщик'),
            'booker_orders_id' => Yii::t('labels', 'Номер в отчет'),
            'act_date' => Yii::t('labels', 'Дата в акт'),
            'act_number' => Yii::t('labels', 'Номер в акт'),
            'seller_id' => Yii::t('labels', 'Продавец'),
            'customers_fax' => Yii::t('labels', 'Факс покупателя'),
            //'orders_discont_comment' => Yii::t('labels', '?'),
        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     *
     * @param string $className
     * @return RetailOrders the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
