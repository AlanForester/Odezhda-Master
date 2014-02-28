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
        $customers = $statuses = $deliveryPoints = $productOptions = /*$defaultProviders = $sellers =*/ $paymentMethods = $currencies = [];

        /*$customersModel = new Customer();
        foreach ($customersModel->findAll() as $customer) {
            $customers[$customer['id']] = $customer['firstname'].' '.$customer['lastname'].' ('.$customer['email'].')';
        }*/

        foreach (RetailOrdersStatuses::model()->findAll() as $status) {
            $statuses[$status['id']] = $status['name'];
        }

        foreach (RetailDelivery::model()->findAll() as $deliveryPoint) {
            $deliveryPoints[$deliveryPoint['id']] = $deliveryPoint['name'];
        }

        /*foreach (DefaultProviders::model()->findAll() as $provider) {
            $defaultProviders[$provider['id']] = $provider['name'];
        }

        foreach (Sellers::model()->findAll() as $seller) {
            $sellers[$seller['id']] = $seller['ur'];
        }

        foreach (Currencies::model()->findAll() as $currency) {
            $currencies[$currency['id']] = $currency['name'];
        }

        foreach (PaymentMethods::model()->findAll() as $method) {
            $paymentMethods[$method['id']] = $method['name'];
        }*/

        foreach (ProductOptions::model()->findAll() as $option) {
            $productOptions[$option['products_options_values_id']] = $option['products_options_values_name'];
        }

       foreach([
                    'Оплата (Для физических лиц)',
                    'Оплата наличными при получении',
                    'Оплата по квитанции Сбербанка РФ',
                    'После сборки заказа Вам будет выставлен счет (Для юридических лиц)',
                    'Предоплата на счёт',
                ] as $method)
            $paymentMethods[$method] = $method;

        $currencies = ['RUR'=>'RUR'];

        $referrer = Yii::app()->request->getQuery('referrer', '#');

        if(is_array($referrer) && $referrer['id'] && $referrer['url'] == 'customers/edit') {
            $item = OrdersHelper::getOrder($id, $scenario);
//            $item->customer = CustomersHelper::getCustomerWithInfo($referrer['id'], $scenario);
            if($referrer['id']) {
                $item->customers_id = $referrer['id'];
                $item->customers_name = $item->customer->customers_firstname . ' ' . $item->customer->customers_lastname;
                $item->customers_city = $item->customer->default_address==null || $item->customer->default_address->entry_city==null ? "-" : $item->customer->default_address->entry_city;
                $item->customers_telephone = $item->customer->customers_telephone;
            }
        } else {
            $item = OrdersHelper::getOrderWithInfo($id, $scenario);
        }

        if (!$item){
            $this->error('Ошибка получения данных оптового заказа');
        }


        $form_action = Yii::app()->request->getPost('form_action');
        if (!empty($form_action)) {
            // записываем пришедшие с запросом значения в модель, чтобы не сбрасывать уже набранные данные в форме
            $item->setAttributes(OrdersHelper::getPostData(),false);
            // записываем данные
            $result = $item->save();

            if ($result) {
                $id = $id ? : Yii::app()->db->lastInsertID;     //$item->getPrimaryKey();

                $productsResult = Yii::app()->session['OrdersProductsEditingStorage'] ?
                    OrdersProductsHelper::applyProductsEditingStorage($id) :
                    true;

                if ($productsResult !== true) {
                    // ошибка записи
                    Yii::app()->user->setFlash(
                        TbHtml::ALERT_COLOR_ERROR,
                        CHtml::errorSummary($productsResult, 'Ошибка сохранения товаров розничного заказа')
                    );

                    //если после создания заказа не сохранились его товары,
                    //то удаляем созданный заказ, чтобы не плодить клонов при данной ошибке
                    if($this->action->id == 'add')
                        Orders::model()->deleteByPk($id);

                } else {
                    // выкидываем сообщение
                    Yii::app()->user->setFlash(
                        TbHtml::ALERT_COLOR_INFO,
                        'Розничный заказ ' . ($id ? 'сохранен' : 'добавлен')
                    );
                    if ($form_action == 'save') {
                        $this->redirect(['index']);
                        return;
                    } else {
                        $this->redirect(['edit', 'id' => $item['id']]);
                        return;
                    }
                }

            } else {
                // ошибка записи
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_ERROR,
                    CHtml::errorSummary($item, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' розничного заказа')
                );
            }

        } else {
            //открытие страницы редактирования.
            //создаем временное хранилище товаров заказа,
            //изменения в котором будут сохранены в бд
            //при сохранении заказа
            if (!$this->isAjax && !is_array($referrer))
                OrdersProductsHelper::createProductsEditingStorage($id);

        }

        $productsCriteria = [
            'page_size' => 10,
        ];
        $productsCriteria['filters']['orders_id'] = $id === null ? -1 : $id;

        //товары из сессии, подготовленные для сохранения
        $productsGridDataProvider = OrdersProductsHelper::mergeDataProviders(
            [
                OrdersProductsHelper::getExistingProductsFromEditingStorage()
            ],
            $productsCriteria['page_size']
        );

        $this->render('edit', compact('item', 'customers', 'statuses', 'deliveryPoints', 'paymentMethods', 'currencies', 'productsCriteria', 'productOptions', 'productsGridDataProvider'));
    }
}
