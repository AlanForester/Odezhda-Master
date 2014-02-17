<?php

class RetailOrdersProductsLayer extends RetailOrdersProducts {

    public function getDataProvider($criteria = null) {
        return RetailOrdersProductsHelper::getDataProvider($criteria);
    }

    public function updateField($params = []) {
        return RetailOrdersProductsHelper::updateField($params);
    }

    public function getPostData() {
        $name = get_class(RetailOrdersProductsHelper::getModel());
        return isset($_POST[$name]) ? $_POST[$name] : [];
    }

    public function getRetailOrdersProduct($id, $scenario = null) {
        return RetailOrdersProductsHelper::getRetailOrdersProduct($id, $scenario);
    }

    public function saveProducts($products, $orderId) {
        if($products && $orderId) {
            //echo '<pre>'.print_r($products,1);exit;
            foreach($products as $product) {
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

?>
