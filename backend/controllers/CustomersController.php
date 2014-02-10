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

        $this->render('index', compact('criteria','gridDataProvider'));
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
}
