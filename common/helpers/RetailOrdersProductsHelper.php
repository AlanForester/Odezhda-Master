<?php

class RetailOrdersProductsHelper extends CommonHelper {

    public static function getDataProvider($data = null, $modelClass = 'RetailOrdersProductsLayer') {

        if(!empty($data['text_search']))
            $data['text_search']['columns'] = [
                'products_model',
                'products_name',
                'products_price',
                'final_price',
                //'products_tax',
                //'products_quantity',
                'products_sort',
                'comment',
            ];

        return parent::getDataProvider($data,$modelClass);
    }

    public static function updateField($data = [], $modelClass = 'RetailOrdersProductsLayer') {
        return parent::updateField($data, $modelClass);
    }

    public static function getRetailOrdersProduct($id = null, $scenario = null) {
        $model = self::getModel();
        return ($id ? $model->findByPk($id) : new $model($scenario));
    }

    public static function getModel() {
        return RetailOrdersProducts::model();
    }
}
