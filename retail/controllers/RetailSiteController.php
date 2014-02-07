<?php

/**
 * Basic "kitchen sink" controller for frontend.
 * It was configured to be accessible by `/site` route, not the `/frontendSite` one!
 *
 * @package YiiBoilerplate\Frontend
 */
class RetailSiteController extends RetailController {
    public $catalogData;
    public $categories;
    /**
     * Actions attached to this controller
     *
     * @return array
     */
    public function actions() {
        return [
            'error' => 'SimpleErrorAction',
            'logout' => 'LogoutAction',
        ];
    }

    public function actionIndex() {

        $categoriesModel = new ShopCategoriesModel();
        $this->categories = $categoriesModel->getClearCategoriesList();
        $catalogModel =new CatalogModel();
        $this->catalogData= $catalogModel->frontCatalogData();

        $this->render("/site/index");
    }

    
    public function actionProduct() {
        $this->render("/site/product");
    }

    public function actionCatalog(){
        $this->render('/site/catalog');
    }

    public function actionLogin(){
        $user = Yii::app()->user;
        $this->redirectAwayAlreadyAuthenticatedUsers($user);

        $model = new RetailLoginForm();
//        $this->respondIfAjaxRequest($request, $model);
        $formData = Yii::app()->request->getPost(get_class($model), false);


        if ($formData) {

            $model->setAttributes($formData,false);

            if ($model->validate(array('username', 'password')) && $model->login())
                $this->redirect($user->returnUrl);
        }

//        $this->controller->layout = '//layouts/blank';
//        $this->controller->render('login', compact('model'));
//        $this->render('/site/index');
    }

    private function redirectAwayAlreadyAuthenticatedUsers($user) {
        if (!$user->isGuest)
            $this->redirect('/');
//            $this->redirect(Yii::app()->request->baseUrl);
    }
    public function actionRegistration() {
        $user = Yii::app()->user;
        $this->redirectAwayAlreadyAuthenticatedUsers($user);

        $model = new RetailRegisterForm();
        $formData = Yii::app()->request->getPost(get_class($model), false);

        if ($formData) {

            $model->setAttributes($formData);
//            print_r($model);exit;
            if ($model->registration())
                $this->redirect($user->returnUrl);
            else {
                print_r($model->getErrors());
                exit;
            }
        }

//        $this->redirect($user->returnUrl);
//        $this->render("/site/index");
    }
}