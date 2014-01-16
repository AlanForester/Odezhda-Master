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
        $model = new UsersModel();
        $users=UsersModel::model()->findAll();
        print_r($users[0]->attributes['admin_lastname']);

        //$val = 'fdgdfgdfsgd';
        //$this->render('index', compact('val'));

    }
}
