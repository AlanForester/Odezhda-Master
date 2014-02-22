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

    public static function insertProducts($products, $orderId) {
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

    public static function queueProduct($retailProduct) {
        $retailProducts = Yii::app()->session['RetailOrdersProductsQueue'];
        $lastSavedRetailProduct = $retailProducts === null ? false : end($retailProducts);
        $retailProduct['id'] = $lastSavedRetailProduct === false ? -1 : $lastSavedRetailProduct['id']-1;  //(count($retailProducts) + 1) * -1;
        $retailProducts[] = $retailProduct;
        Yii::app()->session['RetailOrdersProductsQueue'] = $retailProducts;
        //echo '<pre>'.print_r(Yii::app()->session['RetailOrdersProductsQueue'],1);exit;
        return true;
    }

    public static function deleteQueuedProduct($id) {
        $retailProducts = Yii::app()->session['RetailOrdersProductsQueue'];
        foreach($retailProducts as $key => $product) {
            if($product['id'] == $id) {
                unset($retailProducts[$key]);
                Yii::app()->session['RetailOrdersProductsQueue'] = $retailProducts;
                return true;
            }
        }
        return false;
    }

    public static function updateProductStorageField($data, $storageName) {
        $field = TbArray::getValue('field', $data, false);
        $rowId = TbArray::getValue('id', $data, false);
        $value = TbArray::getValue('value', $data, false);

        if ($rowId && $field && $value !== false) {
            $retailProducts = Yii::app()->session[$storageName];
            foreach($retailProducts as $key => $product) {
                if($product['id'] == $rowId) {
                    $retailProducts[$key][$field] = $value;
                    Yii::app()->session[$storageName] = $retailProducts;
                    return true;
                }
            }
        }
        return false;
    }

    public static function createProductEditingStorage($orderId) {
        $retailProducts = [];
        foreach(RetailOrdersProducts::model()->findAllByAttributes(array('retail_orders_id'=>$orderId)) as $product) {
            $retailProducts[$product->id] = $product->attributes;
        }
        Yii::app()->session['RetailOrdersProductsEditingStorage'] = $retailProducts;
        echo '<pre>'.print_r(Yii::app()->session['RetailOrdersProductsEditingStorage'],1);exit;
    }

    public static function applyProductEditingStorage($a, $orderId) {
        $storageProducts = Yii::app()->session['RetailOrdersProductsEditingStorage'];
        foreach($storageProducts as $storageProduct) {
            if(!empty($storageProduct['deleted'])) {
                if($storageProduct['id'] > 0)
                    RetailOrdersProducts::model()->deleteByPk($storageProduct['id']);
            } else {
                $product = $storageProduct['id'] > 0 ? RetailOrdersProducts::model()->findByPk($storageProduct['id'])
                    : new RetailOrdersProducts();
                $product->setAttributes($storageProduct);
                if(!$product->save())
                    return false;

            }
        }
        return true;
    }
}
