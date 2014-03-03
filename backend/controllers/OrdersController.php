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

    public function actionEdit($id, $scenario = 'edit') {
        $referrer = Yii::app()->request->getQuery('referrer', '#');

        foreach (ProductOptions::model()->findAll() as $option) {
            $productOptions[$option['products_options_values_id']] = $option['products_options_values_name'];
        }
        if(is_array($referrer) && $referrer['id'] && $referrer['url'] == 'customers/edit') {
            $item = OrdersHelper::getOrder($id, $scenario);
            $item->customer = CustomersHelper::getCustomerWithInfo($referrer['id'], $scenario);
            if($referrer['id']) {
                $item->customers_id = $referrer['id'];
                $item->customers_name = $item->customer->customers_firstname . ' ' . $item->customer->customers_lastname;
                $item->customers_city = $item->customer->default_address==null || $item->customer->default_address->entry_city==null ? "-" : $item->customer->default_address->entry_city;
                $item->customers_telephone = $item->customer->customers_telephone;
            }
        } else {
            $item = OrdersHelper::getOrderWithInfo($id, $scenario);
        }

        $productsCriteria = [
            'page_size' => 10,
        ];
        $productsCriteria['filters']['retail_orders_id'] = $id === null ? -1 : $id;

        //товары из сессии, подготовленные для сохранения
        $productsGridDataProvider = RetailOrdersProductsHelper::mergeDataProviders(
            [
                RetailOrdersProductsHelper::getExistingProductsFromEditingStorage()
            ],
            $productsCriteria['page_size']
        );
        $this->render('edit', compact('item', 'customers', 'statuses', 'deliveryPoints', 'paymentMethods', 'currencies', 'productsCriteria', 'productOptions', 'productsGridDataProvider'));
    }
}
