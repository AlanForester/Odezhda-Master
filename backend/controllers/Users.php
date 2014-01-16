<?php

/**
 * Class Users
 */
class Users extends BackendController
{

//    private $pageTitle = 'Users1';

//    public $val;

    public function actionIndex()
    {
        $val='fdgdfgdfsgd';
//        $this->render('index');
        $this->render('index', compact('val'));
    }
}
