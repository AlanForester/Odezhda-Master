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

    public function actionEdit($id, $scenario = 'edit') {
        $form_action = Yii::app()->request->getPost('form_action');

        if (!empty($form_action)) {
            $saved = $this->save($_POST['UsersModel'], $scenario);

            if (!$saved) {
                $this->redirect(Yii::app()->request->urlReferrer);
            } else {

                if ($form_action == 'save') {
                    $this->redirect(['index']);
                    return;
                } else {
                    $this->redirect(['edit', 'id' => $saved['id']]);
                    return;
                }

            }
        }

        $groups_model = new GroupsModel();
        $groups = [];
        foreach ($groups_model->getList() as $g) {
            $groups[$g['id']] = $g['name'];
        }

        $model = new UsersModel($scenario);

        $user = $model->getUserData($id, $scenario);
        if ($user) {
            $model->setAttributes($user, false);
        } else
            $this->error();

        $this->render('edit', compact('model', 'groups'));
    }

    private function save($formData, $scenario) {
        $model = new UsersModel($scenario);
        //$this->performAjaxValidation($model);
        $id = $formData['id'];

//        $model->setAttributes($formData);

//        if (!$model->validate($formData)) {
//            Yii::app()->user->setFlash(
//                TbHtml::ALERT_COLOR_ERROR,
//                CHtml::errorSummary($model, 'vlid Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' пользователя! ')
//            );
//            return false;
//        }

        // отправляем в модель данные
        $result = $model->save($formData);
        // print_r($model->getErrors($model->email));exit;
        if (!$result) {
            //$this->error();
            Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_ERROR,
//                'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' пользователя!'
                CHtml::errorSummary($model, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' пользователя')
            );

            return $result;
        }

        // выкидываем сообщение
        Yii::app()->user->setFlash(
            TbHtml::ALERT_COLOR_INFO,
            'Пользователь ' . ($id ? 'сохранен' : 'добавлен')
        );

        return $result;
//        }
//        else{
//            Yii::app()->user->setFlash(
//                TbHtml::ALERT_COLOR_ERROR,
//                'Ошибка ' . ($id ? 'сохранения' : 'добавления') .' пользователя!'
//            );
//            return false;
//        }
    }

    public function actionAdd() {
        $this->actionEdit(null, 'add');
    }

    public function actionDelete($id) {
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

    public function actionMass() {
        $mass_action = Yii::app()->request->getParam('mass_action');
        $ids = array_unique(Yii::app()->request->getParam('ids'));
        switch ($mass_action) {
            case 'delete':
                foreach ($ids as $id) {
                    $this->actionDelete($id);
                }
                break;
        }

        $this->actionIndex();
    }
}
