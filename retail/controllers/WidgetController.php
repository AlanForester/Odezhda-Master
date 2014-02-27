<?php

class WidgetController extends RetailController {

    public function actionMain() {
        $callback = Yii::app()->request->getQuery('callback', 'LapanaWidget.initCallback');

        $response = [];
        echo $callback . '(' . CJSON::encode($response) . ')';
        Yii::app()->end();
    }

    public function actionAdd() {

    }

}