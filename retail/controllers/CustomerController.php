<?php

class CustomerController extends RetailController {

    public function actionIndex() {
        $customer_id=Yii::app()->user->id;
        if (!empty($customer_id)){
            $model = new CustomerModel();
            if($customer = $model->getCustomer($customer_id)){
                $form_action = Yii::app()->request->getPost('form_action');
                if (!empty($form_action)) {

                    // записываем пришедшие с запросом значения в модель, чтобы не сбрасывать уже набранные данные в форме
                    $data = CustomersHelper::getPostData();
                    if(isset($data['password']) && empty($data['password']))
                        unset($data['password']);
                    $customer->setAttributes($data,false);
                    $result = $customer->save();

                    if (!$result) {
                        // ошибка записи
                        Yii::app()->user->setFlash(
                            TbHtml::ALERT_COLOR_ERROR,
                            CHtml::errorSummary($customer, 'Ошибка сохраниения клиента')
                        );

                    } else {
                        //$item->getPrimaryKey() и $item->id не срабатывают, видимо, из-за манипуляций LegacyAR.
                        //пришлось ставить Yii::app()->db->lastInsertID
                        $customer->customers_info->setAttributes(
                            [
                                'id' => $customer_id ? : Yii::app()->db->lastInsertID
                            ],
                            false
                        );

                        if (!$customer->customers_info->save()) {
                            // ошибка записи
                            Yii::app()->user->setFlash(
                                TbHtml::ALERT_COLOR_ERROR,
                                CHtml::errorSummary($customer->customers_info, 'Ошибка сохранения информации о клиенте')
                            );
                        } else {
                            // выкидываем сообщение
                            Yii::app()->user->setFlash(
                                TbHtml::ALERT_COLOR_INFO,
                                'Изменения сохранены'
                            );
                        }
                    }
                }
                $this->render("/site/customer", compact('customer'));
                Yii::app()->end();
            }
        }
        $this->error('Пользователь не найден',404);
    }

    protected function error($msg = 'Ошибка',$code = 400) {
        throw new CHttpException($code, Yii::t('err', $msg));
    }


}
