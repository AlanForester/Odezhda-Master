<?php

/**
 * Class CustomersController
 */
class CustomersController extends BackendController {

    public $gridDataProvider;

    public $pageTitle = 'Покупатели: список';
    public $pageButton = [];
    public $model;

    public function actionIndex() {

        $criteria = [
            'text_search' => [
                'value' => $this->userStateParam('text_search'),
            ],
            'filters' => $this->userStateParam('filters'),
            'order' => [
                'field' => $this->userStateParam('order_field'),
                'direction' => $this->userStateParam('order_direct'),
            ],
            'page_size' => $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE)
        ];

        $this->model = new Customer('update');

        $gridDataProvider = CustomersHelper::getDataProvider($criteria);
        $gridDataProvider->setSort(false);

        $groups = [];

        /*foreach (CustomersGroups::model()->findAll() as $group) {
            $groups[$group['id']] = $group['name'];
        }*/

        //echo '<pre>'.print_r($this->model->find(),1);die();
        $this->render('index', compact('criteria','gridDataProvider', 'groups'));
    }

    public function actionUpdate() {
        $this->model = new Customer('update');

        $params['field'] = $this->model->getFieldMapName(Yii::app()->request->getPost('name'), false);
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['value'] = Yii::app()->request->getPost('value');

        if (!CustomersHelper::updateField($params,'Customer')) {
            $this->error(CHtml::errorSummary($this->model, 'Ошибка изменения данных розничного заказа'));
        }
    }

    public function actionAdd() {
        $this->actionEdit(null, 'add');
    }

    public function actionEdit($id, $scenario = 'edit') {
        $groups = [];

        /*foreach (CustomersGroups::model()->findAll() as $group) {
            $groups[$group['id']] = $group['name'];
        }*/

        $model = new CustomerLayer($scenario);
        if (!$item = $model->getCustomer($id, $scenario)){
            $this->error('Ошибка получения данных розничного заказа');
        }

        $form_action = Yii::app()->request->getPost('form_action');
        if (!empty($form_action)) {
            // записываем пришедшие с запросом значения в модель, чтобы не сбрасывать уже набранные данные в форме
            $item->setAttributes($model->getPostData(),false);
            // записываем данные
            $result = $item->save($model->getPostData());

            if (!$result) {
                // ошибка записи
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_ERROR,
                    CHtml::errorSummary($model, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' покупателя')
                );
            } else {
                // выкидываем сообщение
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_INFO,
                    'Покупатель ' . ($id ? 'сохранен' : 'добавлен')
                );
                if ($form_action == 'save') {
                    $this->redirect(['index']);
                    return;
                } else {
                    $this->redirect(['edit', 'id' => $item['id']]);
                    return;
                }
            }
        }

        $this->render('edit', compact('item', 'groups'));
    }

    public function actionDelete($id) {
        $model = CustomerLayer::model()->findByPk($id);
        if (!$model->delete()) {
            $this->error();
        } else {
            Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_INFO,
                'Покупатель удален'
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
