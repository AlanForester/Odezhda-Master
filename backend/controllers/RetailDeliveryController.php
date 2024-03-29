<?php

/**
 * Class Users
 */
class RetailDeliveryController extends BackendController {

    public $pageTitle = 'Отделения доставки: список';
    public $pageButton = [];
    //    public $model;

    //    public $groups = [];

    public function actionIndex() {
        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct'),

            'page_size' => $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE)
        ];

        // получение данных
        $model = new RetailDeliveryModel();
        $gridDataProvider = $model->getDataProvider($criteria);

        $this->render('index', compact('criteria', 'gridDataProvider'));
    }

    /**
     * Метод для редактирования одного поля пользователя
     */
    public function actionUpdate() {
        $params['field'] = Yii::app()->request->getPost('name');
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['value'] = Yii::app()->request->getPost('value');

        $model = new RetailDeliveryModel();
        if (!$model->updateField($params)) {
            $this->error(CHtml::errorSummary($model, 'Ошибка изменения данных отделения доставки'));
        }
    }

    public function actionEdit($id, $scenario = 'edit') {
        //        $groups_model = new GroupsModel();
        //        $groups = [];
        //        foreach ($groups_model->getList() as $g) {
        //            $groups[$g['id']] = $g['name'];
        //        }

        $model = new RetailDeliveryModel($scenario);
        if (!$item = $model->getDelivery($id, $scenario)) {
            $this->error('Ошибка получения данных отделения доставки');
        }

        $form_action = Yii::app()->request->getPost('form_action');
        if (!empty($form_action)) {
            // записываем пришедшие с запросом значения в модель, чтобы не сбрасывать уже набранные данные в форме
            $item->setAttributes($model->getPostData(), false);
            // записываем данные
            $result = $model->save($model->getPostData());

            if (!$result) {
                // ошибка записи
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_ERROR,
                    CHtml::errorSummary($model, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' отделения доставки')
                );
            } else {
                // выкидываем сообщение
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_INFO,
                    'Отделения доставки ' . ($id ? 'сохранено' : 'добавлено')
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

        $this->render('edit', compact('item'));
    }

    public function actionAdd() {
        $this->actionEdit(null, 'add');
    }

    public function actionDelete($id) {
        $model = new RetailDeliveryModel();

        if (!$model->delete($id)) {
            $this->error();
        } else {
            Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_INFO,
                'Отделение доставки удалено'
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