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
            ['retail_orders_id, products_id', 'numerical', 'integerOnly' => true, 'message'=>Yii::t('validation', 'Поле {attribute} является числовым')],
            ['retail_orders_id, products_id, products_name', 'required', 'on' => 'add', 'message' => Yii::t('validation', 'Поле {attribute} является обязательным')],
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
            'products_model' => Yii::t('labels', 'Код модели'),
            'products_name' => Yii::t('labels', 'Название'),
            'products_price' => Yii::t('labels', 'Цена (за единицу)'),
            'final_price' => Yii::t('labels', 'Цена (без налога)'),
            'products_tax' => Yii::t('labels', 'Налог'),
            'products_quantity' => Yii::t('labels', 'Количество'),
            'products_av' => Yii::t('labels', 'Наличие товара'),
            'products_sort' => Yii::t('labels', 'Сортировка'),
            'customers_telephone' => Yii::t('labels', 'Телефон'),
            'customers_email_address' => Yii::t('labels', 'E-mail'),
            'delivery_name' => Yii::t('labels', 'Имя'),
            'delivery_middlename' => Yii::t('labels', 'Отчество'),
            'delivery_lastname' => Yii::t('labels', 'Фамилия'),
            'delivery_company' => Yii::t('labels', 'Компания'),
            'delivery_street_address' => Yii::t('labels', 'Адрес'),
            'delivery_suburb' => Yii::t('labels', 'Район города'),
            'delivery_city' => Yii::t('labels', 'Город'),
            'delivery_postcode' => Yii::t('labels', 'Почтовый индекс'),
            'delivery_state' => Yii::t('labels', 'Регион'),
            'delivery_country' => Yii::t('labels', 'Страна доставки'),
            'billing_name' => Yii::t('labels', 'Имя'),
            'billing_company' => Yii::t('labels', 'Компания'),
            'billing_street_address' => Yii::t('labels', 'Адрес'),
            'billing_suburb' => Yii::t('labels', 'Район города'),
            'billing_city' => Yii::t('labels', 'Город'),
            'billing_postcode' => Yii::t('labels', 'Почтовый индекс'),
            'billing_state' => Yii::t('labels', 'Регион'),
            'billing_country' => Yii::t('labels', 'Страна'),
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
            'customers_fax' => Yii::t('labels', 'Факс'),
            //'orders_discont_comment' => Yii::t('labels', '?'),
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
