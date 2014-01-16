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
        $users=$model->getAllUsers();
        //print_r($users);

        //$val = 'fdgdfgdfsgd';
        $this->render('index', compact('users'));

    }
}
