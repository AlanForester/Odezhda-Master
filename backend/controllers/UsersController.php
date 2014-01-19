<?php

/**
 * Class Users
 */
class UsersController extends BackendController {
    /**
     * @var
     */
    public $gridDataProvider;

    public $pageTitle = 'Менеджер пользователей: список';
    public $pageButton = [];
    public $model;
    public $groups = [];

    private function error($msg = 'Something wrong in your request!') {
        throw new CHttpException(400, Yii::t('err', $msg));
        return;
    }

    public function actionIndex() {
        $criteria = [
            'text_search' => Yii::app()->request->getParam('text_search'),
            'filter_groups' => Yii::app()->request->getParam('filter_groups'),
            'filter_created' => Yii::app()->request->getParam('filter_created'),
            'order_field' => Yii::app()->request->getParam('order_field'),
            'order_direct' => Yii::app()->request->getParam('order_direct')
        ];

        // пагинация
        $page_size = Yii::app()->request->getParam('page_size', Yii::app()->user->getState('page_size', CPagination::DEFAULT_PAGE_SIZE));
        Yii::app()->user->setState('page_size', $page_size);

        // получение данных
        $this->model = new UsersModel();
        $users = $this->model->getList($criteria);
        $this->gridDataProvider = new CArrayDataProvider($users, [
            'keyField' => 'id',
            'pagination' => [
                'pageSize' => ($page_size == 'all' ? count($users) : $page_size),
            ],
        ]);

        $groups_model = new GroupsModel();
        $this->groups[''] = '- По группе -';
        foreach ($groups_model->getList() as $g) {
            $this->groups[$g['id']] = $g['name'];
        }

        $this->render('index', ['page_size' => $page_size]);
    }

    /**
     * Метод для редактирования одного поля пользователя
     */
    public function actionUpdate() {
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

    public function actionEdit($id) {
        $form_action = Yii::app()->request->getPost('form_action');
        if (!empty($form_action)) {
            if ($form_action == 'save') {
                $this->save($_POST['UsersModel']);
                $this->redirect(Yii::app()->createUrl('users/index'));
                return;
            } else {
                $this->save($_POST['UsersModel']);
                $this->redirect(Yii::app()->request->urlReferrer);
                return;
            }
        }

        $model = new UsersModel();
        $user = $model->getUser($id);
        if ($user) {
            $model->setAttributes($user, false);
            $this->render('edit', compact('model'));
        } else
            $this->error();
    }

    private function save($formData) {
        $model = new UsersModel();
        if (!$model->changeUser($formData)) {
            $this->error();
        } else {
            Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_INFO,
                'Пользователь сохранен'
            );
        }
    }
}
