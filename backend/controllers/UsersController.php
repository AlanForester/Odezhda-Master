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

    public $pageTitle = 'Менеджер пользователей: список';
    public $pageButton = [];
    public $model;
    public $groups=[];

    private function error($msg='Something wrong in your request!') {
        throw new CHttpException(400, Yii::t('err', $msg));
        return;
    }

    public function actionIndex()
    {
        $this->model = new UsersModel();
        $users=$this->model->getAllUsers();
        $this->gridDataProvider=new CArrayDataProvider($users, array(
            'keyField'=>'id',
            'pagination'=>array(
                'pageSize'=>15,
            ),
        ));

        $groups_model = new GroupsModel();
        foreach ($groups_model->getList() as $g){
            $this->groups[$g['id']]=$g['name'];
        }


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
            $this->error();
        //echo CJSON::encode(array('success' => false,'msg'=>'test'));
        //new CException();
//        Yii::app()->end();
    }

    public function actionEdit($id)
    {
        //print_r($_POST);exit;
        if (!empty($_POST['form_action'])){
            if($_POST['form_action']=='save'){
                $this->save($_POST['UsersModel']);
                $this->redirect( Yii::app()->createUrl('users/index'));
                return;
            }
            else{
                $this->save($_POST['UsersModel']);
                $this->redirect(Yii::app()->request->urlReferrer);
                return;
            }
        }

        $model = new UsersModel();
        $user=$model->getUser($id);
        if ($user){
            $model->setAttributes($user,false);
            $this->render('edit', compact('model'));
        }
        else
            $this->error();
        //print_r($user);exit;
        //$this->render('index');
    }

    private  function save($formData) {
        $model = new UsersModel();
        if (!$model->changeUser($formData))
            $this->error();
    }
}
