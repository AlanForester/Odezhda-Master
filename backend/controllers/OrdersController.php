<?php

/**
 * Class OrderController
 */
class OrdersController extends BackendController
{

    public $pageTitle = 'Оптовые заказы: список';
    public $pageButton = [];
    public $model;

    public function actionIndex(){
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
        // получение данных
        $this->model = new OrdersModel();
        $gridDataProvider = $this->model->getDataProvider($criteria);

        $groups_model = new GroupsModel();
        foreach ($groups_model->getList() as $g) {
            $groups[$g['id']] = $g['name'];
        }

        $this->render('index', compact('page_size', 'criteria', 'gridDataProvider'));
    }
    /**
     * Метод для редактирования одного поля в оптовых заказах
     */
    public function actionUpdate() {
        $params['field'] = Yii::app()->request->getPost('name');
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['value'] = Yii::app()->request->getPost('value');

        $model = new OrdersModel();
        if (!$model->updateField($params)) {
            $this->error(CHtml::errorSummary($model, 'Ошибка изменения данных пользователя'));
        }
    }
}
