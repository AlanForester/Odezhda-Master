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

        $this->model = new RetailOrdersProductsLayer('update');

        $gridDataProvider = $this->model->getDataProvider($criteria);
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

        $this->model = new RetailOrdersProductsLayer('update');
        if (!$this->model->updateField($params)) {
            $this->error(CHtml::errorSummary($this->model, 'Ошибка изменения данных товара'));
        }
    }

    public function actionAdd($id) {
        $this->actionEdit(null, 'add', $id);
    }

    public function actionEdit($id, $scenario = 'edit', $orderId = null) {

        $model = new RetailOrdersProductsLayer($scenario);
        if (!$item = $model->getRetailOrdersProduct($id, $scenario)){
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
            $item->setAttributes($model->getPostData(),false);
            // записываем данные
            $result = $item->save($model->getPostData());

            if (!$result) {
                // ошибка записи
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_ERROR,
                    CHtml::errorSummary($model, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' товара')
                );
            } else {
                // выкидываем сообщение
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_INFO,
                    'Товар ' . ($id ? 'сохранен' : 'добавлен')
                );
                if ($form_action == 'save') {
                    $this->redirect(['order', 'id' => $item['retail_orders_id']]);
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
        $model = RetailOrdersProductsLayer::model()->findByPk($id);
        if (!$model->delete()) {
            $this->error();
        } else {
            Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_INFO,
                'Товар удален из заказа'
            );
        }
    }

    public function actionMass($id) {
        $mass_action = Yii::app()->request->getParam('mass_action');
        $ids = array_unique(Yii::app()->request->getParam('ids'));
        switch ($mass_action) {
            case 'delete':
                foreach ($ids as $productId) {
                    $this->actionDelete($productId);
                }
                break;
        }

        $this->actionOrder($id);
    }

}
