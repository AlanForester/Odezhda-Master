<?php

/**
 * Class Users
 */
class UsersController extends BackendController
{
    /**
     * @var
     */
    public $gridDataProvider;

    public function actionIndex()
    {
        $model = new UsersModel();
        $users=$model->getAllUsers();

//        $users = [
//            ['id'=>10,'name'=>'test1'],
//            ['id'=>20,'name'=>'test2'],
//            ['id'=>30,'name'=>'test3'],
//            ['id'=>40,'name'=>'test4'],
//        ];
        //$this->gridDataProvider = new CArrayDataProvider($users);
        $this->gridDataProvider=new CArrayDataProvider($users, array(
            'keyField'=>'admin_id',

            'sort'=>array(
                'attributes'=>array(
                    'admin_id', 'username', 'email',
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
        //print_r($gridDataProvider);exit;
        //$val = 'fdgdfgdfsgd';

        $this->render('index');

    }
}
