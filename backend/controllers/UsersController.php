<?php

/**
 * Class Users
 */
class UsersController extends BackendController {
    /**
     * @var
     */
    //    public $gridDataProvider;

    public $pageTitle = 'Менеджер пользователей: список';
    public $pageButton = [];
    public $model;

    //    public $groups = [];

    public function actionIndex() {
        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'filter_groups' => $this->userStateParam('filter_groups'),
            'filter_created' => $this->userStateParam('filter_created'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct'),

            'page_size' => $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE)
        ];

        // пагинация
//        $page_size = $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE);

        // получение данных
        $this->model = new UsersModel();
        //        $users = $this->model->getList($criteria);
        //        $this->gridDataProvider = new CArrayDataProvider($users, [
        //            'keyField' => 'id',
        //            'pagination' => [
        //                'pageSize' => ($page_size == 'all' ? count($users) : $page_size),
        //            ],
        //        ]);

        $gridDataProvider = $this->model->getDataProvider($criteria); //UsersLayer::getActiveProvider();

        $groups_model = new GroupsModel();
//        $groups[''] = '- По группе -';
        foreach ($groups_model->getList() as $g) {
            $groups[$g['id']] = $g['name'];
        }

        $this->render('index', compact('page_size', 'criteria', 'gridDataProvider', 'groups'));
    }

    /**
     * Метод для редактирования одного поля пользователя
     */
    public function actionUpdate() {
        $params['field'] = Yii::app()->request->getPost('name');
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['value'] = Yii::app()->request->getPost('value');

        $model = new UsersModel();
        if (!$model->updateField($params)) {
            $this->error(CHtml::errorSummary($model, 'Ошибка изменения данных пользователя'));
        }
    }

    public function actionEdit($id, $scenario = 'edit') {
        $groups_model = new GroupsModel();
        $groups = [];
        foreach ($groups_model->getList() as $g) {
            $groups[$g['id']] = $g['name'];
        }

        $model = new UsersModel($scenario);
        if (!$item = $model->getUser($id, $scenario)){
            $this->error('Ошибка получения данных пользователя');
        }

        $form_action = Yii::app()->request->getPost('form_action');
        if (!empty($form_action)) {
            // записываем пришедшие с запросом значения в модель, чтобы не сбрасывать уже набранные данные в форме
            $item->setAttributes($model->getPostData(),false);
//            $model->setAttributes($_POST['UsersModel'], false);
            // записываем данные
            $result = $model->save($model->getPostData());

            if (!$result) {
                // ошибка записи
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_ERROR,
                    CHtml::errorSummary($model, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' пользователя')
                );
                //$this->redirect(Yii::app()->request->urlReferrer);
//                $this->render('edit', compact('item', 'groups'));
//                return;
            } else {
                // выкидываем сообщение
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_INFO,
                    'Пользователь ' . ($id ? 'сохранен' : 'добавлен')
                );
                if ($form_action == 'save') {
                    $this->redirect(['index']);
                    return;
                } else {
                    $this->redirect(['edit', 'id' => $result['id']]);
                    return;
                }
            }
        }

//        $user = $model->getUserData($id, $scenario);
//        if ($user) {
//            $model->setAttributes($user, false);
//        } else
//            $this->error();

        $this->render('edit', compact('item', 'groups'));
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