<?php

/**
 * Controller action representing the act of home page rendering on backend.
 *
 * Everything which should be done when user opens the backend landing page is here.
 *
 * @package YiiBoilerplate\Backend
 *
 * todo: перенести в основной контроллер страницы
 */
class BackendHomePageAction extends CAction {
    /**
     * We render the homepage as a controller action here.
     */
    public function run() {
        //        $user = Yii::app()->user;
        //        if ($user->isGuest){
        //            $this->controller->redirect(Yii::app()->request->baseUrl.'/site/login');
        //        }

        //$this->controller->layout = '//layouts/main';
        $usersDataProvider = '';

        // список пользовалетей
        $usersModel = new UsersModel();
//        $users = $usersModel->getList(
//            [
//                'order_field' => 'created',
//                'order_direct' => 'down',
//                'criteria' => ['limit' => 5]
//            ]
//        );
        $users = [];
        $usersDataProvider = new CArrayDataProvider($users);

        // список товаров
        $productsModel = new CatalogModel();
        $products = [];
        // todo: не работает лимит
//        $products = $productsModel->getListAndParams(
//            [
//                'order_field' => 'created',
//                'order_direct' => 'down',
//                'criteria' => ['limit' => 5]
//            ]
//        );
        $productsDataProvider = new CArrayDataProvider($products);

        $this->controller->render('index', compact('usersDataProvider', 'productsDataProvider'));
    }
} 