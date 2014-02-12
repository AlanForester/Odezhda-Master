<?php

class CartController extends RetailController {


    public function actionIndex() {

        $this->render("/site/info", compact('cart'));
    }

    public function actionShow() {
        $this->renderPartial("/layouts/parts/basket", compact('cart'));
    }

    public function actionAdd() {
        $data['customer_id'] = Yii::app()->request->getParam('id');
        $data['product_id'] = Yii::app()->request->getParam('id');
        $count=2;
        $this->renderPartial("/layouts/parts/bottomPanel", compact('count'));
    }

}