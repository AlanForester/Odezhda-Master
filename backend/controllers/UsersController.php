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
        $this->gridDataProvider=new CArrayDataProvider($users, array(
            'keyField'=>'id',
//            'sort'=>array(
//                'attributes'=>array(
//                    'admin_id', 'username', 'email',
//                ),
//            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

        $this->render('index');

    }
}
