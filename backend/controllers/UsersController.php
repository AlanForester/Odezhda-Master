<?php

/**
 * Class Users
 */
class UsersController extends BackendController
{

//    private $pageTitle = 'Users1';

//    public $val;

    public function actionIndex()
    {
        $val = 'fdgdfgdfsgd';
        $this->render('index', compact('val'));
    }

    public function accessRules()
    {
        return array(
            // разрешаем все для группы админов
//            [
//                'allow',
//                'role' => ['administrator']
//            ],

            // todo: после прикручивания системы прав, включить управление по ролям
            // запрещаем все для всех
            [
                'deny',
                'users' => ['?'],
            ],
        );
    }

    public function filters()
    {
        return array(
            'accessControl',
        );
    }
}
