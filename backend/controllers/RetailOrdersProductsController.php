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
        //if(!$id)
            $this->redirect(array('retail_orders/index'));

        /*else {
            $this->forward('retail_orders/edit');
        }*/
    }

    public function actionUpdate() {
        $params['field'] = Yii::app()->request->getPost('name');
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['value'] = Yii::app()->request->getPost('value');

        if (!RetailOrdersProductsHelper::updateProductEditingStorageField($params)) {
            $this->error('Ошибка изменения данных товара');
        }
    }

    public function actionDelete($id) {
        if (RetailOrdersProductsHelper::removeProductFromEditingStorage($id)) {
            /*Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_INFO,
                'Товар удален из заказа'
            );*/

            //echo 'Товар удален из заказа';
        }
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
            $this->forward('retail_orders/edit');
            //$this->actionIndex($id);
        } else
            $this->forward('retail_orders/add');
    }

    //добавляет товар для заказа в очередь на сохранение.
    //товары в очереди будут сохранены при сохранении заказа
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
                'params' => $input['params']['size'],    //CJSON::encode($input['params']),
            ];

            $productsResult = RetailOrdersProductsHelper::addProductToEditingStorage($retailProduct);
            if($productsResult !== true) {
                //saving error
            }
        }
    }

}
