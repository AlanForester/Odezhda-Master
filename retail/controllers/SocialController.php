<?php

class SocialController extends RetailController {

    public $catalogData;
    public $categories;

    public function actionVk() {
        $params['access_token']=Yii::app()->request->getQuery('access_token');
        $params['user_id']=Yii::app()->request->getQuery('user_id');
        if ($params['access_token']){
            //порядок сортировки
            $order = Yii::app()->request->getParam('order');
            switch ($order) {
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

            // получение товаров в категории
            $data = $model->getDataProvider($criteria,Yii::app()->params['socialPageSize']);
            $dataProvider=$data['dataProvider'];
            $limitPrice=$data['priceLimit'];

            // общее кол-во доступных товаров
            // не считает товары если нет опций

            $totalCount = $dataProvider->getTotalItemCount();

            // пагинация
            $pages = new CPagination($totalCount);
            $pages->pageSize = Yii::app()->params['socialPageSize'];
            $dataProvider->setPagination($pages);

            if(!$order){
                $this->layout = '//layouts/main_social';
                $this->render('/social/index',compact('pages','dataProvider','totalCount','limitPrice'));
            }
            else{
                $this->renderPartial('/social/index',compact('pages','dataProvider','totalCount','limitPrice'));
            }
        } else{
            $this->error();
        }
    }

    public function actionAddToCart(){
        //todo сделать получение данных пользователя из вк
        $customer_id=Yii::app()->user->id;
        if (!empty($customer_id)){
            $data['customer_id'] = $customer_id;
            $data['product_id'] = Yii::app()->request->getParam('product_id');
            $data['params'] = Yii::app()->request->getParam('params');
            $data['added'] = new CDbExpression('NOW()');
            $model = new CartModel();
            if($model->addToCart($data)){
                echo CartModel::countProducts();
                Yii::app()->end();
            }
            $error='Ошибка добавления товара в корзину';
        } else {
            $data['product_id'] = Yii::app()->request->getParam('product_id');
            $data['params'] = Yii::app()->request->getParam('params');
            $data['added'] = new CDbExpression('NOW()');
            $model = new CartModel();
            if($model->addToSession($data)){
                echo CartModel::countProducts();
                Yii::app()->end();
            }
            $error='Ошибка добавления товара в корзину';
        }
//        $this->renderPartial("/layouts/parts/bottomPanelError", compact('error'));

    }
}