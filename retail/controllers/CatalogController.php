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
    public $categories = [];
    public $currentCategory = [];
    public $currentCategoryNumber;

    public $DataProvider;

    public function actionIndex() {

        $catalogModel = new CatalogModel();
        //        $this->catalogData = $catalogModel->frontCatalogData();
        $this->render("/site/product");
    }


    public function actionProduct($id = null) {
        if ($id != null) {
            $categoriesModel = new ShopCategoriesModel();
            $this->categories = $categoriesModel->getClearCategoriesList();

            $catalogModel = new CatalogModel();
            if ($this->product = $catalogModel->productById($id)) {
                $this->render("/site/product");
            } else {
                $this->render("/site/error");
            }
        } else {
            $this->render("/site/error");
        }
    }

    public function actionList($id = 0) {
        $criteria = [
            'current_category' => $id,
            'current_page' => (Yii::app()->request->getQuery('page') ? : 1)
        ];

        // Категории
        $categoriesModel = new ShopCategoriesModel();
        // todo: сделать переменной, а не свойством контроллера
        $this->categories = $categoriesModel->getClearCategoriesList();

        // получение данных
        $model = new CatalogModel();
        // todo: сделать переменной, а не свойством контроллера
        $this->DataProvider = $model->getDataProvider($criteria);

        // todo: шаблон - catalog
        // todo: criteria - ? DataProvider - ?
        $this->render('/site/custom_index', compact('page_size', 'criteria', 'DataProvider'));
    }


    public function actionError() {
        $this->render("/site/error");
    }
}