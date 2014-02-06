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
    public $count;
    public $categories=[];
    public $currentCategory=[];
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


    /**
     * @param int $id - category_id
     */
    public function actionList($id=0) {

        $params['offset'] = Yii::app()->request->getPost('offset');

        if($params['offset']){
            $catalogModel = new CatalogModel();
         //   $this->list = $catalogModel->frontCatalogData();

        }



        $categoriesModel = new ShopCategoriesModel();
        $this->categories = $categoriesModel->getClearCategoriesList();

        $catalogModel = new CatalogModel();
        $filter=[];

        $list_and_count = $catalogModel->frontCatalogList($params['offset'],$id);

        $this->list=$list_and_count['list'];
        $this->count=$list_and_count['count'];
        $this->currentCategory=$list_and_count['current_category'];


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