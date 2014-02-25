<?php

class SocialController extends RetailController {

    public function actionVk() {
        $params['access_token']=Yii::app()->request->getQuery('access_token');
        $params['user_id']=Yii::app()->request->getQuery('user_id');
        if ($params['access_token']){
            /*todo обращение к модели. сейчас просто выдаем вид*/
            $this->layout = 'main_social';
            $this->renderPartial('index');
        }

    }
}