<?php

class CartController extends RetailController {


    public function actionIndex() {

        $this->render("/site/info", compact('cart'));
    }

    public function actionShow() {
        $this->renderPartial("/layouts/parts/basket", compact('cart'));
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