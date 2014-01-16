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
}
