<?php

/**
 * Class RetailOrdersProductsController
 */
class RetailOrdersProductsController extends BackendController {

    public $gridDataProvider;

    public $pageTitle = 'Товары в розничном заказе: список';
    public $pageButton = [];
    public $model;


    public function actionIndex($id = null) {
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

        $retailOrders = [];

        if($id !== null) {
            $criteria['filters']['retail_orders_id'] = $id;

        } else {
            foreach (RetailOrdersLayer::model()->findAll() as $order) {
                $retailOrders[$order['id'].'&'] = $order['id'] . ' (' . $order['customers_name'] . ')';
            }
        }

        $gridDataProvider = RetailOrdersProductsHelper::getDataProvider($criteria);
        $gridDataProvider->setSort(false);

        $this->render('index', compact('id','criteria','gridDataProvider', 'retailOrders'));
    }

    /*public function actionOrder($id) {
        $this->actionIndex($id);
    }*/

    public function actionUpdate() {
        $params['field'] = Yii::app()->request->getPost('name');
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['value'] = Yii::app()->request->getPost('value');

        if($params['id'] > 0) {
            $this->model = new RetailOrdersProducts('update');
            if (!RetailOrdersProductsHelper::updateField($params)) {
                $this->error(CHtml::errorSummary($this->model, 'Ошибка изменения данных товара'));
            }

        } else {
            if (!RetailOrdersProductsHelper::updateProductStorageField($params, 'RetailOrdersProductsQueue')) {
                $this->error('Ошибка изменения данных товара');
            }
        }
    }

    public function actionAdd($id) {
        $this->actionEdit(null, 'add', $id);
    }

    public function actionEdit($id, $scenario = 'edit', $orderId = null) {

        $model = new RetailOrdersProducts($scenario);
        if (!$item = RetailOrdersProductsHelper::getRetailOrdersProduct($id, $scenario)){
            $this->error('Ошибка получения данных товара');
        }

        $item->retail_orders_id = $item->retail_orders_id ? : $orderId;

        $products = [];
        $productsModel = new CatalogModel();
        foreach ($productsModel->getListAndParams([]) as $product) {
            $products[$product['id']] = $product['name'] . ' (' . $product['model'] . ')';
        }

        $form_action = Yii::app()->request->getPost('form_action');
        if (!empty($form_action)) {
            // записываем пришедшие с запросом значения в модель, чтобы не сбрасывать уже набранные данные в форме
            $item->setAttributes(RetailOrdersProductsHelper::getPostData(),false);
            // записываем данные
            $result = $item->save();

            if (!$result) {
                // ошибка записи
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_ERROR,
                    CHtml::errorSummary($item, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' товара')
                );
            } else {
                // выкидываем сообщение
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_INFO,
                    'Товар ' . ($id ? 'сохранен' : 'добавлен')
                );
                if ($form_action == 'save') {
                    $this->redirect(['retail_orders/edit', 'id' => $item['retail_orders_id']]);
                    return;
                } else {
                    $this->redirect(['edit', 'id' => $item['id']]);
                    return;
                }
            }
        }

        $this->render('edit', compact('orderId', 'item', 'products'));
    }

    public function actionDelete($id) {
        /*if($id > 0) {
            $model = RetailOrdersProducts::model()->findByPk($id);
            if (!$model->delete()) {
                $this->error();
            } else {
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_INFO,
                    'Товар удален из заказа'
                );
            }

        } else {*/
            if (RetailOrdersProductsHelper::removeProductFromEditingStorage($id))
                /*Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_INFO,
                    'Товар удален из заказа'
                );*/
                echo 'Товар удален из заказа';
        //}
    }

    public function actionMass($id = null) {
        $mass_action = Yii::app()->request->getParam('mass_action');
        $productIds = array_unique(Yii::app()->request->getParam('ids'));
        switch ($mass_action) {
            case 'delete':
                foreach ($productIds as $productId) {
                    $this->actionDelete($productId);
                }
                break;
        }

        if($id) {
            $this->actionIndex($id);
        } else
            $this->forward('retail_orders/add');
    }

    //добавляет товар для создаваемого заказа (который еще не имеет id) в очередь на сохранение.
    //товары в очереди будут сохранены при сохранении создаваемого заказа
    public function actionQueue() {
        $input = RetailOrdersProductsHelper::getPostData();
        if(!empty($input['productId'])) {
            //todo CformModel => AR
            $model = new CatalogModel();
            $product = $model->getCatalogData($input['productId'],'edit');
            $retailProduct = [
                'id' => null,
                'retail_orders_id' => !empty($input['orderId']) ? $input['orderId'] : null,
                'products_id' => $input['productId'],
                'model' => $product['model'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $input['quantity'],
                'params' => CJSON::encode($input['params']),
            ];

            /*if(!empty($input['orderId'])) {
                $productsResult = RetailOrdersProductsHelper::insertProducts([$retailProduct], $input['orderId']);
                if($productsResult !== true) {
                    //saving error
                }
            } else {*/
                $productsResult = RetailOrdersProductsHelper::addProductToStorage($retailProduct, 'RetailOrdersProductsEditingStorage');
                if($productsResult !== true) {
                    //saving error
                }
            //}
        }
    }

}
