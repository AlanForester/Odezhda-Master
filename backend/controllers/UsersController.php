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
    }

    /**
     * Получить параметр из сессии или запроса. Запрос имеет более высокий приоритет перед данными
     * из сессии. Полученный параметр будет перезаписн в пользовательские данные
     * @param string $param имя параметра
     * @param null $default [опционально] значение по умолчанию
     * @return mixed найденное и записанное значение
     */
    private function userStateParam($param, $default = null) {
        $data = Yii::app()->request->getParam(
            $param,
            Yii::app()->user->getState($param, $default)
        );

        Yii::app()->user->setState($param, $data);
        return $data;
    }

    public function actionIndex() {
        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'filter_groups' => $this->userStateParam('filter_groups'),
            'filter_created' => $this->userStateParam('filter_created'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct')
        ];

        // пагинация
        //        $page_size = Yii::app()->request->getParam('page_size', Yii::app()->user->getState('page_size', CPagination::DEFAULT_PAGE_SIZE));
        //        Yii::app()->user->setState('page_size', $page_size);
        $page_size = $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE);

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

        $this->render('index', ['page_size' => $page_size, 'criteria' => $criteria]);
    }

    /**
     * Метод для редактирования одного поля пользователя
     */
    public function actionUpdate() {
        $params['field'] = Yii::app()->request->getPost('name');
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['newValue'] = Yii::app()->request->getPost('value');

        $model = new UsersModel();
        if (!$model->updateField($params)) {
            $this->error();
        }
    }

    public function actionEdit($id) {
        $form_action = Yii::app()->request->getPost('form_action');

        if (!empty($form_action)) {
            $saved = $this->save($_POST['UsersModel']);

            if ($form_action == 'save') {
                $this->redirect(['index']);
                return;
            } else {
                $this->redirect(['edit', 'id' => $saved['id']]);
                return;
            }
        }

        $groups_model = new GroupsModel();
        $groups = [];
        foreach ($groups_model->getList() as $g) {
            $groups[$g['id']] = $g['name'];
        }

        $model = new UsersModel();

        $user = $model->getUserData($id);
        if ($user) {
            $model->setAttributes($user, false);
        } else
            $this->error();

        $this->render('edit', compact('model', 'groups'));
    }

    private function save($formData) {
        $model = new UsersModel();
        $id = $formData['id'];

        // отправляем в модель данные
        $result = $model->save($formData);
        if (!$result) {
            $this->error();
        }

        // выкидываем сообщение
        Yii::app()->user->setFlash(
            TbHtml::ALERT_COLOR_INFO,
            'Пользователь ' . ($id ? 'сохранен' : 'добавлен')
        );

        return $result;
    }

    public function actionAdd() {
        $this->actionEdit(null);
    }

    public function actionDelete($id){
        $model = new UsersModel();

        if (!$model->delete($id)) {
            $this->error();
        } else {
            Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_INFO,
                'Пользователь удален'
            );
        }
    }

    public function actionMass(){
        $mass_action = Yii::app()->request->getParam('mass_action');
        $ids = array_unique(Yii::app()->request->getParam('ids'));
        switch ($mass_action){
            case 'delete':
                foreach ($ids as $id){
                    $this->actionDelete($id);
                }
                break;
        }
    }
}
