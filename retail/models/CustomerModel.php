<?php

/**
 * Корзина
 */
class CustomerModel extends CFormModel {

    public function getCustomer($customer_id){
        return CustomersHelper::getCustomerWithInfo($customer_id) ? :false;
    }
    public function getCustomerByEmail($email){
        return CustomersHelper::findByAttributes(['email'=>$email]) ? :false;
    }
}
