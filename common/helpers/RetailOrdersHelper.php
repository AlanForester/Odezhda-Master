<?php

class RetailOrdersHelper extends CommonHelper {

    public static function getDataProvider($data = null, $modelClass = 'RetailOrdersLayer') {

        if(!empty($data['text_search']))
            $data['text_search']['columns'] = [
                'customers_name',
                /*'customers_company',
                'customers_street_address',
                'customers_suburb',*/
                'customers_city',
                /*'customers_postcode',
                'customers_state',
                'customers_country',*/
                'customers_telephone',
                /*'customers_email_address',
                'delivery_name',
                'delivery_middlename',
                'delivery_lastname',
                'delivery_company',
                'delivery_street_address',
                'delivery_suburb',
                'delivery_city',
                'delivery_postcode',
                'delivery_state',
                'delivery_country',
                'billing_name',
                'billing_company',
                'billing_street_address',
                'billing_suburb',
                'billing_city',
                'billing_postcode',
                'billing_state',
                'billing_country',
                'payment_method',
                'payment_info',
                'customers_fax'*/
            ];

        $data['condition'] = [
            'orders_id IS NULL'
        ];

        return parent::getDataProvider($data,$modelClass);
    }

    public static function updateField($data = [], $modelClass = 'RetailOrdersLayer') {
        return parent::updateField($data, $modelClass);
    }

    public static function getRetailOrder($id = null, $scenario = null) {
        $model = self::getModel();
        return ($id ? $model->findByPk($id) : new $model($scenario));
    }

    public static function getModel() {
        return RetailOrders::model();
    }
}
