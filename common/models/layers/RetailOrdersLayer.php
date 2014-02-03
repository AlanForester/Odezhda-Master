<?php

class RetailOrdersLayer extends RetailOrders {

    public function getDataProvider($criteria = null) {
        return RetailOrdersHelper::getDataProvider($criteria);
    }

    public function updateField($params = []) {
        return RetailOrdersHelper::updateField($params);
    }
}

?>
