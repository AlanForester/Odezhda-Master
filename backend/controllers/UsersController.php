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
            'pagination'=>array(
                'pageSize'=>15,
            ),
        ));
        $this->render('index');

    }

    public function actionUpdate()
    {
//        $model = new UsersModel();
//        $users=$model->getAllUsers();
//
//        $this->render('index');
        $params['field'] = Yii::app()->request->getPost('name');
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['newValue'] = Yii::app()->request->getPost('value');
        $model = new UsersModel();
        if (!$model->changeUserField($params))
            throw new CHttpException(400, Yii::t('err', 'Bad request!'));
        //echo CJSON::encode(array('success' => false,'msg'=>'test'));
        //new CException();
//        Yii::app()->end();
    }
}
