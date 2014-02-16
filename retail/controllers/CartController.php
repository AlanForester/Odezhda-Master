<?php

class CartController extends RetailController {

    public function actionShow($showBottomPanel=false) {
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
                $this->renderPartial("/layouts/parts/basket", compact('products','product_ids'));
                Yii::app()->end();
            }
            $this->renderPartial("/layouts/parts/emptyBasket");
            Yii::app()->end();
        }
        $error='Ошибка : неизвестный пользователь';
        $this->renderPartial("/layouts/parts/bottomPanelError", compact('error'));

    }

    public function actionAdd() {
        $customer_id=Yii::app()->user->id;
        if (!empty($customer_id)){
            $data['customer_id'] = $customer_id;
            $data['product_id'] = Yii::app()->request->getParam('product_id');
            $data['params'] = Yii::app()->request->getParam('params');
            $data['added'] = new CDbExpression('NOW()');
            $model = new CartModel();
            if($model->addToCart($data)){
//                $count = $model->countProducts($data['customer_id']);
                $this->renderPartial("/layouts/parts/bottomPanel");
                Yii::app()->end();
            }
            $error='Ошибка добавления товара в корзину';
        } else {
            $error='Ошибка добавления в корзину : неизвестный пользователь. Пожалуйста, авторизируйтесь.';
        }
        $this->renderPartial("/layouts/parts/bottomPanelError", compact('error'));

    }

    public function actionChangeCounter() {
        $customer_id=Yii::app()->user->id;
        if (!empty($customer_id)){
            $product_id = Yii::app()->request->getParam('product_id');
            $change = Yii::app()->request->getParam('change');
            $model = new CartModel();
            if($model->updateProduct($customer_id,$product_id,$change)){
                $data['items'] = $model->countItemsOfProduct($product_id);
                $data['products'] = CartModel::countProducts();
                echo json_encode($data);
                Yii::app()->end();
            }
        }
    }

    public function actionDeleteProduct(){
        $customer_id=Yii::app()->user->id;
        if (!empty($customer_id)){
            $product_id = Yii::app()->request->getParam('product_id');
            $model = new CartModel();
            if($model->deleteProduct($customer_id,$product_id)){
                $this->actionShow(true);
            }
        }
    }

    public function actionDeleteAll(){
        $customer_id=Yii::app()->user->id;
        if (!empty($customer_id)){
            $model = new CartModel();
            if($model->deleteAll($customer_id)){
                $this->actionShow(true);
            }
        }
    }

    public function actionMakeOrder(){
        $customer_id=Yii::app()->user->id;
        if (!empty($customer_id)){
            $model = new CartModel();
            if($model->makeOrder($customer_id)){
                $data['lightbox']=$this->renderPartial("/layouts/parts/order",null,true);
                $data['bottomPanel']=$this->renderPartial("/layouts/parts/bottomPanel",null,true);
                echo json_encode($data);
                Yii::app()->end();
            }
            $error='Ошибка оформления заказа.';

        } else {
            $error='Ошибка оформления заказа: неизвестный пользователь. Пожалуйста, авторизируйтесь.';
        }
        $data['bottomPanel']=$this->renderPartial("/layouts/parts/bottomPanelError", compact('error'),true);
        echo json_encode($data);
    }

}