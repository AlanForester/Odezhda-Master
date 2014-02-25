<?php

class RetailOrdersProductsHelper extends CommonHelper {

    private static $storageName = 'RetailOrdersProductsEditingStorage';

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

    /*public static function insertProducts($products, $orderId) {
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
    }*/

    public static function addProductToEditingStorage($retailProduct) {
        $retailProducts = Yii::app()->session[self::$storageName];
        $lastAddedRetailProduct = $retailProducts === null ? false : end($retailProducts);
        $retailProduct['id'] = $lastAddedRetailProduct === false || $lastAddedRetailProduct['id'] > 0 ? -1
            : $lastAddedRetailProduct['id']-1;
        $retailProducts[] = $retailProduct;
        Yii::app()->session[self::$storageName] = $retailProducts;
        //echo '<pre>'.print_r(Yii::app()->session['RetailOrdersProductsQueue'],1);exit;
        return true;
    }

    /*public static function deleteQueuedProduct($id) {
        $retailProducts = Yii::app()->session['RetailOrdersProductsQueue'];
        foreach($retailProducts as $key => $product) {
            if($product['id'] == $id) {
                unset($retailProducts[$key]);
                Yii::app()->session['RetailOrdersProductsQueue'] = $retailProducts;
                return true;
            }
        }
        return false;
    }*/

    public static function updateProductEditingStorageField($data) {
        $field = TbArray::getValue('field', $data, false);
        $rowId = TbArray::getValue('id', $data, false);
        $value = TbArray::getValue('value', $data, false);

        if ($rowId && $field && $value !== false) {
            $retailProducts = Yii::app()->session[self::$storageName];
            foreach($retailProducts as $key => $product) {
                if($product['id'] == $rowId) {
                    $retailProducts[$key][$field] = $value;
                    Yii::app()->session[self::$storageName] = $retailProducts;
                    return true;
                }
            }
        }
        return false;
    }

    public static function createProductsEditingStorage($orderId) {
        $retailProducts = [];
        if($orderId)
            foreach(RetailOrdersProducts::model()->findAllByAttributes(array('retail_orders_id'=>$orderId)) as $product) {
                $retailProducts[$product->id] = $product->attributes;
            }
        Yii::app()->session[self::$storageName] = $retailProducts;
    }

    public static function removeProductFromEditingStorage($id) {
        $retailProducts = Yii::app()->session[self::$storageName];
        foreach($retailProducts as $key => $product) {
            if($product['id'] == $id) {
                $retailProducts[$key]['removed'] = 1;
                Yii::app()->session[self::$storageName] = $retailProducts;
                return true;
            }
        }
        return false;
    }

    public static function getExistingProductsFromEditingStorage() {
        $resultProducts = [];
        $storageProducts = Yii::app()->session[self::$storageName];
        foreach($storageProducts as $storageProduct) {
            if(empty($storageProduct['removed'])) {
                $resultProducts[] = $storageProduct;
            }
        }
        return $resultProducts;
    }

    public static function applyProductsEditingStorage($orderId) {
        $storageProducts = Yii::app()->session[self::$storageName];
        //var_dump($storageProducts);exit;
        //echo '<pre>'.print_r($storageProducts,1);exit;
        foreach($storageProducts as $storageProduct) {
            if(!empty($storageProduct['removed'])) {
                if($storageProduct['id'] > 0) {
                    $model = RetailOrdersProducts::model()->findByPk($storageProduct['id']);
                    if(!$model->delete())
                        return $model;
                }
            } else {
                //if($orderId) {
                    $model = $storageProduct['id'] > 0 ? RetailOrdersProducts::model()->findByPk($storageProduct['id'])
                        : new RetailOrdersProducts('add');
                    unset($storageProduct['id']);
                    $model->setAttributes($storageProduct);
                    $model->retail_orders_id = $model->retail_orders_id ? : $orderId;
                    $model->params = $model->params === '' ? 0 : $model->params;
                    if(!$model->save())
                        return $model;
                //}

            }
        }
        return true;
    }
}
