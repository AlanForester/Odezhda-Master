<?php

class WidgetController extends RetailController {

    public function actionMain() {
        $callback = Yii::app()->request->getQuery('callback', 'LapanaWidget.initCallback');

        //выбор товара дня из категории "акции" 1435 или Спецпредложение 590
        $category = 1435;
        $dayProducts = ShopProductsHelper::widgetDayProducts($category);

        $response = [
            'html' => $this->renderPartial('main', compact('dayProducts'), true)
        ];
        echo $callback . '(' . CJSON::encode($response) . ')';
        Yii::app()->end();
    }

    public function actionAdd() {

    }

}