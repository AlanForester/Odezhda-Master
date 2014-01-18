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

    public $pageTitle = 'Пользователи';
    public $pageButton = [

    ];

    public function actionIndex()
    {
        $model = new UsersModel();
        $users=$model->getAllUsers();
        $this->gridDataProvider=new CArrayDataProvider($users, array(
            'keyField'=>'id',
            'pagination'=>array(
                'pageSize'=>15,
            ),
        ));
        $this->render('index');

    }

    /**
     * Метод для редактирования одного поля пользователя
     */
    public function actionUpdate()
    {
        $params['field'] = Yii::app()->request->getPost('name');
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['newValue'] = Yii::app()->request->getPost('value');
        $model = new UsersModel();
        if (!$model->changeUserField($params))
            throw new CHttpException(400, Yii::t('err', 'Something wrong in your request!'));
        //echo CJSON::encode(array('success' => false,'msg'=>'test'));
        //new CException();
//        Yii::app()->end();
    }

    public function actionEdit($id)
    {
        $model = new UsersModel();
        $user=$model->getUser($id);
        //$model = new BackendLoginForm();
        if ($user){
            $this->render('edit', compact('model','user'));
        }
        else
            throw new CHttpException(400, Yii::t('err', 'Something wrong in your request!'));
        //print_r($user);exit;
        //$this->render('index');
    }
}
