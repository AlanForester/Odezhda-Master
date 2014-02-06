<?php

class CartController extends RetailController {


    public function actionIndex() {

        $this->render("/site/info", compact('cart'));
    }

}