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
        $categoryAcciy = 1435;
        $day_data = $catalogModel->dayProduct($categoryAcciy);

        // todo: вынести в настройки?
        // баннеры
        $banners = [
            0 => RetailBannersHelper::getBanner(1),
            1 => RetailBannersHelper::getBanner(2),
            2 => RetailBannersHelper::getBanner(3),
        ];

        $this->render("/site/index", compact('day_data', 'banners'));
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
            if (!$model->validate(array('username', 'password')) || !$model->login()) {
                //отдаем виду ошибки для отображения
                echo json_encode($model->errors);
            }else{
                if(!empty($_SESSION['products'])){
                    $cartModel = new CartModel();
                    $cartModel->addGoodsFromSession();
                }
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
            }else{
                if(!empty($_SESSION['products'])){
                    $cartModel = new CartModel();
                    $cartModel->addGoodsFromSession();
                }
            }

            //завершаем приложение в любом случае
            Yii::app()->end();
        }
        $this->renderPartial('/layouts/parts/register');
    }

    /**
     * Восстановление пользователя (забыл пароль)
     */
    public function actionRecovery() {
        $user = Yii::app()->user;
        $this->redirectAwayAlreadyAuthenticatedUsers($user);
        $email = Yii::app()->request->getPost('email', false);
        if ($email) {
            $model = new RecoverModel();
            //проверяем, сущесвтует ли пользователь по имейлу
            if ($model->isCustomerExist($email)) {
                if ($hash = $model->recover()) {
                    $message = new YiiMailMessage;
//                    $message->view = 'registrationFollowup';
                    $message->setSubject('Восстановление пароля на сайте Lapana');
                    $body = '
                    Здравствуйте!
                    На ваш email было оформлено восстановление пароля.
                    Если вы действительно хотите восстановить пароль, перейдите, пожалуйста по ссылке '
                        . $this->createAbsoluteUrl('site/restoreCustomer', ['code' => $hash]) . '.
                    Если вы не желаете восстанавливать ваш пароль на сайте, проигнорируйте это сообщение.
                    ';
                    $message->setBody($body);
                    $message->setTo($email);
//                    $message->setFrom('noreply@lapana.ru');
                    $message->setFrom(Yii::app()->params['contactEmail']);
                    $ii = Yii::app()->mail->send($message);
                    //сообщение для отображения
                    $responce = 'Сообщение с рекоендациями по восстановлению пароля выслано вам на email.';
                } else {
                    $responce = 'Ошибка. Попытайтесь еще раз';
                }
            } else {
                $responce = 'Указанного пользователя не существует';
            }
            $this->renderPartial('/layouts/parts/recovery_responce', compact('responce'));
            //завершаем приложение в любом случае
            Yii::app()->end();
        }
        $this->renderPartial('/layouts/parts/recovery');
    }

    public function actionRestoreCustomer() {
        $hash = Yii::app()->request->getQuery('code', false);
        if (!empty($hash)) {
            $model = new RecoverModel();
            if ($model->restoreCustomer($hash)) {
                $this->redirect($this->createUrl('/customer/index'));
            }
        }
        $this->redirect('/');
    }

    public function actionTest() {
        $dataProvider = new CActiveDataProvider(
            'NewProduct',
            [
                'pagination' => ['pageSize' => 12],
                'criteria'=>[
//                    'condition'=>'categories.categories_id = 429'
//                    'group'=>'t0_c0'
                ]
            ]
        );

        foreach ($dataProvider->getData() as $n=>$prod){
//            print_r($prod);exit;
            $categories = [];
            foreach ($prod->categories as $cat){
                $categories[] = $cat->id;
            }
            echo ($n+1).' - '.$prod->name.': '.$prod->id.' ('.join(',',$categories).')'.'<br>';
        }
    }

}