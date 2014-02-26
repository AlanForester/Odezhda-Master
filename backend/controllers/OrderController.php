<?php

/**
 * Class OrderController
 */
class OrderController extends BackendController
{

    public $pageTitle = 'Оптовые заказы: список';
    public $pageButton = [];
    public $model;

    public function actionIndex()
    {
        $this->render('index');
    }
}
