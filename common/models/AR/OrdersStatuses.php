<?php

class OrdersStatuses extends LegacyActiveRecord {

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        return 'orders_status';
    }

    public function relations()
    {
        return[
            'orders_status_name' => [self::BELONGS_TO, 'Orders', 'orders_status_name', 'together' => true]
        ];
    }


}