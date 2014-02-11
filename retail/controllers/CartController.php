<?php

class CartController extends RetailController {


    public function actionIndex() {

        $this->render("/site/info", compact('cart'));
    }

    public function actionShow() {

        $this->renderPartial("/layouts/parts/basket", compact('cart'));
    }

}