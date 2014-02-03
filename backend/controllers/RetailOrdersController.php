<?php

/**
 * Class RetailOrdersController
 */
class RetailOrdersController extends BackendController {

    public $gridDataProvider;

    public $pageTitle = 'Розничные заказы: список';
    public $pageButton = [];
    public $model;
    public $rows = [];

    public function actionIndex() {

        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'filter_status' => $this->userStateParam('filter_status'),
            'filter_deliverypoint' => $this->userStateParam('filter_deliverypoint'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct'),
            'page_size' => $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE)
        ];

        // пагинация
//        $page_size = $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE);

        // получение данных
        $this->model = new RetailOrdersLayer();
//        $gridDataProvider = $model->getActiveProvider($criteria);

        /*$rows = $this->model->getList([],$criteria);
//        print_r($rows);exit;
        $gridDataProvider = new CArrayDataProvider($rows, [
            //'keyField' => 'id',
            'pagination' => [
                'pageSize'=>count($rows),   //$page_size
            ],
        ]);*/

        $gridDataProvider = $this->model->getDataProvider($criteria);

        foreach (RetailOrdersStatusesLayer::model()->findAll() as $status) {
            $statuses[$status['id']] = $status['name'];
        }

        foreach (DeliveryPointsLayer::model()->findAll() as $deliveryPoint) {
            $deliveryPoints[$deliveryPoint['id']] = $deliveryPoint['name'];
        }

        $vars = compact('criteria','gridDataProvider','statuses', 'deliveryPoints');
        //RetailOrders::model()->findAll()
        //echo '<pre>'.print_r($vars,1);die();
        /*if ($this->isAjax){
            $this->renderPartial('index',$vars);
            Yii::app()->end();
        }*/

        $this->render('index',$vars);
    }
}
