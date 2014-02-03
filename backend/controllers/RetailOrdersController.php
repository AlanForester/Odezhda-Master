<?php

/**
 * Class RetailOrdersController
 */
class RetailOrdersController extends BackendController {

    public $gridDataProvider;

    public $pageTitle = 'Розничные заказы: список';
    public $pageButton = [];
    public $model;

    public function actionIndex() {

        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'filter_status' => $this->userStateParam('filter_status'),
            'filter_deliverypoint' => $this->userStateParam('filter_deliverypoint'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct'),
            'page_size' => $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE)
        ];

        // получение данных
        $this->model = new RetailOrdersLayer();

        $gridDataProvider = $this->model->getDataProvider($criteria);

        foreach (RetailOrdersStatusesLayer::model()->findAll() as $status) {
            $statuses[$status['id']] = $status['name'];
        }

        foreach (DeliveryPointsLayer::model()->findAll() as $deliveryPoint) {
            $deliveryPoints[$deliveryPoint['id']] = $deliveryPoint['name'];
        }

        $this->render('index', compact('criteria','gridDataProvider','statuses', 'deliveryPoints'));
    }

    public function actionUpdate() {
        $params['field'] = Yii::app()->request->getPost('name');
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['value'] = Yii::app()->request->getPost('value');

        $this->model = new RetailOrdersLayer();
        if (!$this->model->updateField($params)) {
            $this->error(CHtml::errorSummary($this->model, 'Ошибка изменения данных розничного заказа'));
        }
    }
}
