<?php

class SocialController extends RetailController {

    public $catalogData;
    public $categories;

    public function actionVk() {
        $params['access_token']=Yii::app()->request->getQuery('access_token');
        $params['user_id']=Yii::app()->request->getQuery('user_id');
        if ($params['access_token']){
            $categoriesModel = new ShopCategoriesModel();
            $this->categories = $categoriesModel->getClearCategoriesList();

            $catalogModel = new CatalogModel();
            $this->catalogData = $catalogModel->frontCatalogData();
            /*todo обращение к модели. сейчас просто выдаем вид*/
            $this->layout = '//layouts/main_social';
            $this->render('/social/index');
        }

    }
}