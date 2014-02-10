<?php

class CustomerLayer extends Customer {

    public function getDataProvider($criteria = null) {
        return CustomersHelper::getDataProvider($criteria);
    }

    public function updateField($params = []) {
        return CustomersHelper::updateField($params);
    }

    public function getPostData() {
        $name = get_class(CustomersHelper::getModel());
        return $_POST[$name];
    }

    public function getCustomer($id, $scenario = null) {
        return CustomersHelper::getCustomer($id, $scenario);
    }
}

?>
