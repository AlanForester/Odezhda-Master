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

        $gridDataProvider = $this->model->getDataProvider($criteria);
        $gridDataProvider->setSort(false);

        $this->render('index', compact('criteria','gridDataProvider'));
    }
}
