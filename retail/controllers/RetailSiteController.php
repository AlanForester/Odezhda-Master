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
        $request = Yii::app()->request;

//        $this->respondIfAjaxRequest($request, $model);

        $formData = $request->getPost(get_class($model), false);
        print_r($formData);exit;

        if ($formData) {

            //print_r($model->attributes); print_r($formData);exit;
            $model->attributes = $formData;
            //print_r($model->attributes);exit;
            if ($model->validate(array('username', 'password')) && $model->login())
                $this->controller->redirect($user->returnUrl);
        }

//        $this->controller->layout = '//layouts/blank';
//        $this->controller->render('login', compact('model'));
        $this->render('/site/index');
    }

    private function redirectAwayAlreadyAuthenticatedUsers($user) {
        if (!$user->isGuest)
            $this->controller->redirect(Yii::app()->request->baseUrl);
    }
}