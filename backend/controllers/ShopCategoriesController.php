<?php

/**
 * Class Users
 */
class ShopCategoriesController extends BackendController {
    /**
     * @var
     */
    public $gridDataProvider;

    public $pageTitle = 'Менеджер категорий: список';
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
//    private function userStateParam($param, $default = null) {
//        $data = Yii::app()->request->getParam(
//            $param,
//            Yii::app()->user->getState($param, $default)
//        );
//
//        Yii::app()->user->setState($param, $data);
//        return $data;
//    }

    public function actionIndex($id=0) {
//        $criteria = [
//            'text_search' => $this->userStateParam('text_search'),
//            'filter_groups' => $this->userStateParam('filter_groups'),
//            'filter_created' => $this->userStateParam('filter_created'),
//            'order_field' => $this->userStateParam('order_field'),
//            'order_direct' => $this->userStateParam('order_direct')
//        ];
        // пагинация
        //        $page_size = Yii::app()->request->getParam('page_size', Yii::app()->user->getState('page_size', CPagination::DEFAULT_PAGE_SIZE));
        //        Yii::app()->user->setState('page_size', $page_size);
        //$page_size = $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE);

        // получение данных
        $model = new ShopCategoriesModel();
        $categories = $model->findByParentId($id);//$users = $this->model->getList($criteria);
        $this->gridDataProvider = new CArrayDataProvider($categories, [
            'keyField' => 'id',
            'pagination' => [
                'pageSize'=>50,
               // 'pageSize' => ($page_size == 'all' ? count($categories) : $page_size),
            ],
        ]);
        //print_r($categories);exit;

//        $groups_model = new GroupsModel();
//        $this->groups[''] = '- По группе -';
//        foreach ($groups_model->getList() as $g) {
//            $this->groups[$g['id']] = $g['name'];
//        }

        //$this->render('index', ['page_size' => $page_size, 'criteria' => $criteria]);
        $this->render('index');
    }

    /**
     * Метод для редактирования одного поля пользователя
     */
//    public function actionUpdate() {
//        $params['field'] = Yii::app()->request->getPost('name');
//        $params['id'] = Yii::app()->request->getPost('pk');
//        $params['newValue'] = Yii::app()->request->getPost('value');
//
//        $model = new UsersModel();
//        if (!$model->updateField($params)) {
//            $this->error();
//        }
//    }
//
    public function actionEdit($id, $scenario = 'edit') {
//        $groups_model = new GroupsModel();
//        $groups = [];
//        foreach ($groups_model->getList() as $g) {
//            $groups[$g['id']] = $g['name'];
//        }

        $model = new ShopCategoriesModel($scenario);

        $form_action = Yii::app()->request->getPost('form_action');
        if (!empty($form_action)) {
            $model->setAttributes($_POST['UsersModel'],false);
            // отправляем в модель данные
            $result = $model->save($_POST['UsersModel']);
            if (!$result) {
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_ERROR,
                    CHtml::errorSummary($model, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' пользователя')
                );
                //$this->redirect(Yii::app()->request->urlReferrer);
                $this->render('edit', compact('model', 'groups'));
                return;
            }
            else {
            // выкидываем сообщение
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_INFO,
                    'Пользователь ' . ($id ? 'сохранен' : 'добавлен')
                );
                if ($form_action == 'save') {
                    $this->redirect(['index']);
                    return;
                } else {
                    $this->redirect(['edit', 'id' => $id]);
                    return;
                }
            }
        }

        $user = $model->getCategoryData($id, $scenario);
        if ($user) {
            $model->setAttributes($user, false);
        } else
            $this->error();

        $this->render('edit', compact('model', 'groups'));
    }

    public function actionAdd() {
        $this->actionEdit(null, 'add');
    }

    public function actionDelete($id) {
        $model = new ShopCategoriesModel();

        if (!$model->delete($id)) {
            $this->error();
        } else {
            Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_INFO,
                'Выбранная категория и все ее дочерние категории удалены'
            );
        }
    }

//    public function actionMass() {
//        $mass_action = Yii::app()->request->getParam('mass_action');
//        $ids = array_unique(Yii::app()->request->getParam('ids'));
//        switch ($mass_action) {
//            case 'delete':
//                foreach ($ids as $id) {
//                    $this->actionDelete($id);
//                }
//                break;
//        }
//
//        $this->actionIndex();
//    }
}
