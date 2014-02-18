<?php

class RetailOrdersProductsHelper extends CommonHelper {

    public static function getDataProvider($data = null, $modelClass = 'RetailOrdersProducts') {

        if(!empty($data['text_search']))
            $data['text_search']['columns'] = [
                'model',
                'name',
                'price',
                'quantity',
                /*'final_price',
                'products_tax',
                'products_sort',
                'comment',*/
            ];

        return parent::getDataProvider($data,$modelClass);
    }

    public static function updateField($data = [], $modelClass = 'RetailOrdersProducts') {
        return parent::updateField($data, $modelClass);
    }

    public static function getRetailOrdersProduct($id = null, $scenario = null) {
        $model = self::getModel();
        return ($id ? $model->findByPk($id) : new $model($scenario));
    }

    public static function getModel() {
        return RetailOrdersProducts::model();
    }

    public static function getPostData() {
        $name = get_class(RetailOrdersProductsHelper::getModel());
        return isset($_POST[$name]) ? $_POST[$name] : [];
    }

    public static function saveNewProducts($products, $orderId) {
        if($products && $orderId) {
            //echo '<pre>'.print_r($products,1);exit;
            foreach($products as $product) {
                $product['id'] = null;
                $model = new RetailOrdersProducts('add');
                $model->setAttributes($product);
                $model->retail_orders_id = $orderId;
                if(!$model->save())
                    return $model;
            }
        }
        return true;
    }
}
