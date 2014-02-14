<?php

class CustomerController extends RetailController {

    public function actionIndex() {

        $this->render("/site/customer", compact('cart'));
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
                    CHtml::errorSummary($item, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' клиента')
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
                        CHtml::errorSummary($item->customers_info, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' информации о клиенте')
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

}