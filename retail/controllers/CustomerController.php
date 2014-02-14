<?php

class CustomerController extends RetailController {

    public function actionIndex() {
        $customer_id=Yii::app()->user->id;
        if (!empty($customer_id)){
            $model = new CustomerModel();
            if($customer = $model->getCustomer($customer_id)){
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
