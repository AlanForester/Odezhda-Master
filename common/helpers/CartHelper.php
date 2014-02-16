<?php

class CartHelper {
    public static function getCart(){
        $customer_id=Yii::app()->user->id;
        if (!empty($customer_id)){
            $model = new CartModel();
            $product_ids=$model->getUserProducts($customer_id);
            if($product_ids){
                $catalogModel = new CatalogModel();
                foreach($product_ids as $id=>$count){
                    if ($product = $catalogModel->productById($id)) {
                        $products[]=$product;
                    }
                }
                return $products;
            }
        }
        return false;
    }
}