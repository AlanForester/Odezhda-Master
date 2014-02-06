<?php

/**
 * Basic "kitchen sink" controller for frontend.
 * It was configured to be accessible by `/site` route, not the `/frontendSite` one!
 *
 * @package YiiBoilerplate\Frontend
 */
class InfoPagesController extends RetailController {


    public function actionIndex($id=null) {
        //принимаем id из поста или из гета
        $id=(!$id ? Yii::app()->request->getParam('id') : $id);

        if($id){
            $pageModel =new InfoPagesModel();
            //обьект информационной страницы
            $infoPage = $pageModel->getInfoPage($id);
            $this->render("/site/info", compact('infoPage'));
        } else {
            //todo редирект на страницу оишбки
        }

    }

    /**
     * Метод перенаправления на actionIndex, когда стучим на controller/id
     * чтобы не изменять конфиг
     * @param null $id
     */
    public function actionView ($id=null){
        $this->actionIndex($id);
    }

}