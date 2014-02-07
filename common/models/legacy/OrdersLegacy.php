<?php

/**
 * This is the model class for table "{{orders}}".
 */
class OrdersLegacy extends LegacyActiveRecord
{
    public $orders_id;
    public $image;

    public $primaryKey='orders_id';

    // здесь мы храним ВСЮ информацию, пришедшую на сохранение
    // и для основной таблице и для связанных
    protected $_allData = [];

    /**
     * Name of the database table associated with this ActiveRecord
     * @return string
     */
    public function tableName()
    {
        return 'orders';
    }


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
