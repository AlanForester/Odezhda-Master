<?php

class CartController extends RetailController {


    public function actionIndex() {

        $this->render("/site/info", compact('cart'));
    }

    public function actionShow() {
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
                $this->renderPartial("/layouts/parts/basket", compact('cart'));
            }
            $this->renderPartial("/layouts/parts/emptyBasket");
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
            $error='Ошибка добавления в корзину : неизвестный пользователь';
        }
        $this->renderPartial("/layouts/parts/bottomPanelError", compact('error'));

    }

}