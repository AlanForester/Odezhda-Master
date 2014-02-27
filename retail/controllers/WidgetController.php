<?php

class WidgetController extends RetailController {

    public function actionIndex() {
        $callback = Yii::app()->request->getQuery('callback', 'LapanaWidget.initCallback');

        //выбор товара дня из категории "акции" 1435 или Спецпредложение 590
        $category = 1435;
        $dayProducts = ShopProductsHelper::widgetDayProducts($category);

        //print_r($dayProducts);die();

        $response = [
            'html' => $this->renderPartial('main', compact('dayProducts'), true)
        ];
        echo $callback . '(' . CJSON::encode($response) . ')';
        Yii::app()->end();
    }

    public function actionAdd() {

    }

}