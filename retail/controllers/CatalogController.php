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
        $data = $model->getDataProvider($criteria);
        $dataProvider=$data['dataProvider'];
        $this->pageTitle = $product->name.' ('.$product->model.')';

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
        $data = $model->getDataProvider($criteria);
        $dataProvider=$data['dataProvider'];

        //        $this->renderPartial('/layouts/parts/productPreview', compact('product','dataProvider'));
//        $this->renderPartial('/layouts/parts/productPreview', compact('product', 'dataProvider'));
        $this->renderPartial('/site/preview', compact('product', 'dataProvider'));
    }

    public function actionList($id = 0) {

        //todo: выкинуть неиспользуемые категории private static $exceptedIds = [327,1435,1354,1333,590];
        $criteria['filter']= [
            'color'=>Yii::app()->request->getQuery('color',[]),
            'size'=>Yii::app()->request->getQuery('size',[]),
        ];

        //Формирование критерии
        $criteria['page'] = (Yii::app()->request->getQuery('page') ? : 1);
        $criteria['min_price'] = (Yii::app()->request->getQuery('min_price') ? : false);
        $criteria['max_price'] = (Yii::app()->request->getQuery('max_price') ? : false);
        $criteria['text_search'] = (Yii::app()->request->getQuery('text_search') ? : false);
        if ($id != 0) {
            $criteria['category'] = $id;
        }

        switch (Yii::app()->request->getQuery('order')) {
//            case true:
//                $url['sort'] = Yii::app()->request->getQuery('sort');
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
            default:
                $criteria['order'] = '[[count_orders]] DESC';
        }

        $model = new CatalogModel();
        // текущая категория
        if (!$currentCetegory = $model->getCategory($id)) {
            $this->error('Категория не найдена', 404);
        }

        // Категории для аккардеона
        $categoriesModel = new ShopCategoriesModel();
        $categories = $categoriesModel->getClearCategoriesList();


        // Определение номера категории
        $currentCategoryNumber=false;

        $i=0;
        $break=0;
        if($id!=0){
            foreach($categories as $category){
                if($category['id']==$id){
                    $currentCategoryNumber=$i;
                    break;
                }
                if(!empty($category['children'])){
                    foreach($category['children'] as $child){
                        if($child['id']==$id){
                            $currentCategoryNumber=$i;
                            $break=1;
                            break;
                        }
                    }
                }
                if($break==1){
                    break;
                }
                $i++;
            }
        }

        // получение товаров в категории
        $data = $model->getDataProvider($criteria);
        $dataProvider=$data['dataProvider'];
        $limitPrice=$data['priceLimit'];

        // общее кол-во доступных товаров
        // не считает товары если нет опций

        $totalCount = $dataProvider->getTotalItemCount();


        // пагинация
        $pages = new CPagination($totalCount);
        $pages->pageSize = Yii::app()->params['frontPageSize'];
        $dataProvider->setPagination($pages);

        // todo: название категории получаем через костыль - исправить
        $catName = $currentCetegory->rel_description->categories_name?:'Весь каталог';

        // титл страницы
        $this->pageTitle = $catName;
            $this->render('/site/catalog', compact('categories', 'catName', 'currentCetegory', 'pages', 'dataProvider', 'totalCount','limitPrice','criteria','currentCategoryNumber'));
    }
}