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
    public $list;
    public $categories=[];
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




        if($id!=null){
        $categoriesModel = new ShopCategoriesModel();
        $this->categories = $categoriesModel->getClearCategoriesList();

        $catalogModel = new CatalogModel();
            if($this->product = $catalogModel->productById($id)){
                $this->render("/site/product");
            }
            else{
                $this->render("/site/error");
            }


        }
        else{
            $this->render("/site/error");
        }
    }



    public function actionList() {

        $params['offset'] = Yii::app()->request->getPost('offset');

        if($params['offset']){
            $catalogModel = new CatalogModel();
         //   $this->list = $catalogModel->frontCatalogData();

        }



        $categoriesModel = new ShopCategoriesModel();
        $this->categories = $categoriesModel->getClearCategoriesList();

        $catalogModel = new CatalogModel();
        $filter=[];
        $this->list = $catalogModel->frontCatalogList($params['offset']);

        if(!empty($params['offset'])){
            $this->renderPartial("/site/catalog_ajax");
        }
        else{
            $this->render("/site/catalog");
        }
    }

    public function actionError() {


        $this->render("/site/error");
    }
}