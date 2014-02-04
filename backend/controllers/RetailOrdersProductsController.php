<?php

/**
 * Class RetailOrdersProductsController
 */
class RetailOrdersProductsController extends BackendController {

    public $gridDataProvider;

    public $pageTitle = 'Продукты в заказе: список';
    public $pageButton = [];
    public $model;


    public function actionIndex() {

    }

    public function actionOrder($orderId) {

        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'filter_status' => $this->userStateParam('filter_status'),
            'filter_deliverypoint' => $this->userStateParam('filter_deliverypoint'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct'),
            'page_size' => $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE)
        ];

        $this->model = new RetailOrdersProductsLayer('update');

        $gridDataProvider = $this->model->getDataProvider($criteria);

        /*$statuses = $deliveryPoints = [];

        foreach (RetailOrdersStatusesLayer::model()->findAll() as $status) {
            $statuses[$status['id']] = $status['name'];
        }

        foreach (DeliveryPointsLayer::model()->findAll() as $deliveryPoint) {
            $deliveryPoints[$deliveryPoint['id']] = $deliveryPoint['name'];
        }*/

        $this->render('order', compact('orderId','criteria','gridDataProvider'));
    }

}
