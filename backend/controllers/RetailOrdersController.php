<?php

/**
 * Class RetailOrdersController
 */
class RetailOrdersController extends BackendController {

    public $gridDataProvider;

    public $pageTitle = 'Розничные заказы: список';
    public $pageButton = [];
    public $rows = [];

    public function actionIndex() {

        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct')
        ];

        // пагинация
//        $page_size = $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE);

        // получение данных
        $model = new RetailOrdersLayer();

        $rows = $model->getList([],$criteria);

        $gridDataProvider = new CArrayDataProvider($rows, [
            //'keyField' => 'id',
            'pagination' => [
                'pageSize'=>count($rows),   //$page_size
            ],
        ]);
        $vars = compact('id','criteria','gridDataProvider');

        if ($this->isAjax){
            $this->renderPartial('index',$vars);
            Yii::app()->end();
        }

        $this->render('index',$vars);
    }
}
