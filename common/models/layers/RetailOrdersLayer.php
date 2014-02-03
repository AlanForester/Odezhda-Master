<?php

class RetailOrdersLayer extends RetailOrders {

    public function getDataProvider($criteria = null) {
        return RetailOrdersHelper::getDataProvider($criteria);
    }

}

?>
