<?php

class CatalogController extends RetailController {
    //    public $catalogData;
    //    public $product;
    //    public $list;
    //    public $count;
    //    public $categories = [];
    //    public $currentCategory = [];
    //    public $currentCategoryNumber;
    //
    //    public $DataProvider;

    public function actionProduct($id = null) {
        $catalogModel = new CatalogModel();
        if (!$product = $catalogModel->productById($id)) {
            $this->error('Товар не найден', 404);
        }
        $this->render('/site/product', compact('product'));
    }

    public function actionList($id = 0) {
        $criteria = [
            'category' => $id,
            'page' => (Yii::app()->request->getQuery('page') ? : 1)
        ];

        // Категории
        $categoriesModel = new ShopCategoriesModel();
        $categories = $categoriesModel->getClearCategoriesList();

        // получение данных
        $model = new CatalogModel();
        $dataProvider = $model->getDataProvider($criteria);

        // общее кол-во доступных товаров
        $totalCount = $dataProvider->getTotalItemCount();

        // пагинация
        $pages = new CPagination($totalCount);
        $pages->pageSize=12;
        $dataProvider->setPagination($pages);

        $this->render('/site/catalog', compact('categories','pages', 'dataProvider','totalCount'));
    }
}