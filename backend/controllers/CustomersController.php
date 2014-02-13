<?php

/**
 * Class CustomersController
 */
class CustomersController extends BackendController {

    public $gridDataProvider;

    public $pageTitle = 'Клиенты: список';
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
            'page_size' => Yii::app()->request->getQuery('from') == 'bootbox' ? 10 :
                $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE)
        ];

        //$this->model = new Customer('update');

        $gridDataProvider = CustomersHelper::getDataProvider($criteria);
        $gridDataProvider->setSort(false);

        $groups = [];

        foreach (CustomerGroups::model()->findAll() as $group) {
            $groups[$group['id'].'&'] = $group['name'];
        }

        $view = Yii::app()->request->getQuery('from') == 'bootbox' ? 'bootbox' : 'index';

        $this->render($view, compact('criteria','gridDataProvider', 'groups'));
    }

    public function actionUpdate() {
        $this->model = new Customer('update');

        $params['field'] = $this->model->getFieldMapName(Yii::app()->request->getPost('name'), false);
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['value'] = Yii::app()->request->getPost('value');

        if (!CustomersHelper::updateField($params,'Customer')) {
            $this->error(CHtml::errorSummary($this->model, 'Ошибка изменения данных клиента'));
        }
    }

    public function actionAdd() {
        $this->actionEdit(null, 'add');
    }

    public function actionEdit($id, $scenario = 'edit') {
        $groups = [];
        $genders = [''=>'Не указан', 'm'=>'Мужчина', 'f'=>'Женщина'];
        $yesNo = ['1'=>'Да', '0'=>'Нет'];

        foreach (CustomerGroups::model()->findAll() as $group) {
            $groups[$group['id']] = $group['name'];
        }

        //$model = new CustomerLayer($scenario);
        if (!$item = CustomersHelper::getCustomerWithInfo($id, $scenario)){
            $this->error('Ошибка получения данных клиента');
        }
        //echo '<pre>'.print_r($item,1);exit;

        $form_action = Yii::app()->request->getPost('form_action');
        if (!empty($form_action)) {

            // записываем пришедшие с запросом значения в модель, чтобы не сбрасывать уже набранные данные в форме
            $data = CustomersHelper::getPostData();
            if(isset($data['password']) && empty($data['password']))
                unset($data['password']);
            $item->setAttributes($data,false);
            $result = $item->save();

            if (!$result) {
                // ошибка записи
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_ERROR,
                    CHtml::errorSummary(CustomersHelper::getModel(), 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' клиента')
                );

            } else {
                //$item->getPrimaryKey() и $item->id не срабатывают, видимо, из-за манипуляций LegacyAR.
                //пришлось ставить Yii::app()->db->lastInsertID
                $item->customers_info->setAttributes(
                    [
                        'id' => $id ? : Yii::app()->db->lastInsertID
                    ],
                    false
                );

                if (!$item->customers_info->save()) {
                    // ошибка записи
                    Yii::app()->user->setFlash(
                        TbHtml::ALERT_COLOR_ERROR,
                        CHtml::errorSummary($item, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' информации о клиенте')
                    );
                } else {
                    // выкидываем сообщение
                    Yii::app()->user->setFlash(
                        TbHtml::ALERT_COLOR_INFO,
                        'Клиент ' . ($id ? 'сохранен' : 'добавлен')
                    );
                    if ($form_action == 'save') {
                        $this->redirect(['index']);
                        return;
                    } else {
                        $this->redirect(['edit', 'id' => $item['id']]);
                        return;
                    }
                }
            }
        }

        $this->render('edit', compact('item', 'groups', 'genders', 'yesNo'));
    }

    public function actionDelete($id) {
        $model = CustomersHelper::getModel()->findByPk($id);
        if (!$model->delete()) {
            $this->error();
        } else {
            Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_INFO,
                'Клиент удален'
            );
        }
    }

    public function actionMass() {
        $mass_action = Yii::app()->request->getParam('mass_action');
        $ids = array_unique(Yii::app()->request->getParam('ids'));
        switch ($mass_action) {
            case 'delete':
                foreach ($ids as $id) {
                    $this->actionDelete($id);
                }
                break;
        }

        $this->actionIndex();
    }

    public function actionInfo($id) {
        $model = CustomersHelper::getCustomerWithAddress($id);
        $response['customer'] = $model;
        $response['default_address'] = $model->default_address;
        echo CJSON::encode($response);
        Yii::app()->end();
    }
}
