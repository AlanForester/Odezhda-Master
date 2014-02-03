<?php

/**
 * Basic "kitchen sink" controller for frontend.
 * It was configured to be accessible by `/site` route, not the `/frontendSite` one!
 *
 * @package YiiBoilerplate\Frontend
 */
class CatalogController extends RetailController {
    public $catalogData;
    public $product;
    /**
     * Actions attached to this controller
     *
     * @return array
     */
//    public function actions() {
//
//        return array(
//            'index' => array(
//                'class' => 'LandingPageAction'
//            ),
//            'error' => array(
//                'class' => 'SimpleErrorAction'
//            )
//        );
//    }

    public function actionIndex() {

        $catalogModel = new CatalogModel();
//        $this->catalogData = $catalogModel->frontCatalogData();
        $this->render("/site/product");
    }


    public function actionProduct($id=null) {

        $catalogModel = new CatalogModel();
        $this->product = $catalogModel->frontCatalogData();
        $this->render("/site/product");
    }


    public function actionError() {


        $this->render("/site/error");
    }
}