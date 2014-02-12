<?php

class CatalogController extends RetailController {

    public function actionProduct($id = null) {
        $catalogModel = new CatalogModel();
        if (!$product = $catalogModel->productById($id)) {
            $this->error('Товар не найден', 404);
        }
        //выборак случайных товаров
        $model = new CatalogModel();
        $criteria['limit'] = 15;
        $criteria['order'] = '[[count_orders]] DESC';
        if ($product->categories_id != 0) {
            $criteria['category'] = $product->categories_id;
        }
        //getTopList
        $dataProvider = $model->getDataProvider($criteria);
        $this->setTitle($product->name);

        $this->render('/site/product', compact('product', 'dataProvider'));
    }

    public function actionPreview($id = null) {
        $catalogModel = new CatalogModel();
        if (!$product = $catalogModel->productById($id)) {
            $this->error('Товар не найден', 404);
        }

        //выборак случайных товаров
        $model = new CatalogModel();
        $criteria['limit'] = 15;
        $criteria['order'] = '[[count_orders]] DESC';
        if ($product->categories_id != 0) {
            $criteria['category'] = $product->categories_id;
        }
        //getTopList
        $dataProvider = $model->getDataProvider($criteria);

        //        $this->renderPartial('/layouts/parts/productPreview', compact('product','dataProvider'));
        $this->renderPartial('/site/preview', compact('product', 'dataProvider'));
    }

    public function actionList($id = 0) {
        //Формирование критерии
        $criteria['page'] = (Yii::app()->request->getQuery('page') ? : 1);
        if ($id != 0) {
            $criteria['category'] = $id;
        }

        switch (Yii::app()->request->getQuery('sort')) {
            case 'hits':
                $criteria['order'] = '[[count_orders]] DESC';
                break;
            case 'date':
                $criteria['order'] = '[[date_add]] DESC';
                break;
            case 'price_down':
                $criteria['order'] = '[[price]] ASC';
                break;
            case 'price_up':
                $criteria['order'] = '[[price]] DESC';
                break;
        }

        $model = new CatalogModel();
        // текущая категория
        if (!$currentCetegory = $model->getCategory($id)) {
            $this->error('Категория не найдена', 404);
        }

        // Категории для аккардеона
        $categoriesModel = new ShopCategoriesModel();
        $categories = $categoriesModel->getClearCategoriesList();

        // получение товаров в категории
        $dataProvider = $model->getDataProvider($criteria);

        // общее кол-во доступных товаров
        $totalCount = $dataProvider->getTotalItemCount();

        // пагинация
        $pages = new CPagination($totalCount);
        $pages->pageSize = 12;
        $dataProvider->setPagination($pages);

        $this->render('/site/catalog', compact('categories', 'currentCetegory', 'pages', 'dataProvider', 'totalCount'));
    }
}