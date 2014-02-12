<?php

class CartController extends RetailController {


    public function actionIndex() {

        $this->render("/site/info", compact('cart'));
    }

    public function actionShow() {
        $this->renderPartial("/layouts/parts/basket", compact('cart'));
    }

    public function actionAdd() {
        $count=2;
        $this->renderPartial("/layouts/parts/bottomPanel", compact('count'));
    }

}