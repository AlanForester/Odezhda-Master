<?php

/**
 * Basic "kitchen sink" controller for frontend.
 * It was configured to be accessible by `/site` route, not the `/frontendSite` one!
 *
 * @package YiiBoilerplate\Frontend
 */
class InfoPagesController extends RetailController {


    public function actionIndex() {

        //принимаем id из поста или из гета
        $id=Yii::app()->request->getParam('id');

        if($id){
            $pageModel =new InfoPagesModel();
            //обьект информационной страницы
            $infoPage = $pageModel->getInfoPage($id);
//            print_r($infoPage);exit;
            $this->render("/site/info", compact('infoPage'));
        } else {

        }


    }

}