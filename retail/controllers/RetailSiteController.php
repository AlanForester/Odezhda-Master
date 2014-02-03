<?php

/**
 * Basic "kitchen sink" controller for frontend.
 * It was configured to be accessible by `/site` route, not the `/frontendSite` one!
 *
 * @package YiiBoilerplate\Frontend
 */
class RetailSiteController extends RetailController {
    public $catalogData;
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
        $this->catalogData = $catalogModel->frontCatalogData();

        $this->render("/site/index");
    }

    
    public function actionProduct() {


        $this->render("/site/product");
    }

    public function actionCatalog()
    {
        $this->render('/site/catalog');
    }
}