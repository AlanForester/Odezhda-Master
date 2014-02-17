<?php
// todo: привести в порядок код - убрать комментированный код, добавить описание методам

/**
 * Контроллер по умолчанию
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

        $catalogModel = new CatalogModel();
        $this->catalogData = $catalogModel->frontCatalogData();


        //выбор товара дня из категории "акции" 1435 или Спецпредложение 590
        $categoryAcciy=1435;
        $day_data = $catalogModel->dayProduct($categoryAcciy);

        // todo: вынести в настройки?
        // баннеры
        $banners = [
            0=>RetailBannersHelper::getBanner(1),
            1=>RetailBannersHelper::getBanner(2),
            2=>RetailBannersHelper::getBanner(3),
        ];

        $this->render("/site/index",compact('day_data','banners'));
    }

    /**
     * Авторизация пользователей
     * Обращение к этому методу происходит через ajax
     */
    public function actionLogin() {
        $user = Yii::app()->user;
        $this->redirectAwayAlreadyAuthenticatedUsers($user);

        $model = new RetailLoginForm();
        $formData = Yii::app()->request->getPost(get_class($model), false);
        if ($formData) {
            $model->setAttributes($formData, false);
            if (!$model->validate(array('username', 'password')) || !$model->login()){
                //отдаем виду ошибки для отображения
                echo json_encode($model->errors);
            }
            //завершаем приложение в любом случае
            Yii::app()->end();
        }
        $this->renderPartial('/layouts/parts/login');
    }

    private function redirectAwayAlreadyAuthenticatedUsers($user) {
        if (!$user->isGuest)
            $this->redirect('/');
        //            $this->redirect(Yii::app()->request->baseUrl);
    }

    /**
     * Регистрация пользователей
     * Обращение к этому методу происходит через ajax
     */
    public function actionRegistration() {
        $user = Yii::app()->user;
        $this->redirectAwayAlreadyAuthenticatedUsers($user);

        $model = new RetailRegisterForm();
        $formData = Yii::app()->request->getPost(get_class($model), false);
        if ($formData) {
            $model->setAttributes($formData, false);
            if (!$model->registration()) {
                //отдаем виду ошибки для отображения
                echo json_encode($model->errors);
            }
            //завершаем приложение в любом случае
            Yii::app()->end();
        }
        $this->renderPartial('/layouts/parts/register');
    }

    /**
     * Обработка запроса на скидку
     */
    public function actionDiscountSend() {
        //        $name = Yii::app()->request->getPost('name');
        //        $email = Yii::app()->request->getPost('email');
        //
        //        $sender = Yii::app()->email;
        //
        //        $sender->to = 'admin@example.com';
        //        $sender->subject = 'Запрос на скидку';
        //        $sender->message = 'Имя: '.$name."\n".'Email: '.$email;
        //        $sender->send();

        // todo: добавить увемоление о событии
        $this->redirect('/');
    }
}