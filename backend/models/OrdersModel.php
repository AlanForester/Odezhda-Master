<?php
/**
 * Created by PhpStorm.
 * User: Zimovid
 * Date: 26.02.14
 * Time: 15:15
 */
class OrdersModel extends CFormModel {

    public function getDataProvider($criteria = null) {
       return OrdersHelper::getDataProvider($criteria);
    }
}