<?php

class ProductOptions extends LegacyActiveRecord {


    public function tableName() {
        return 'products_options_values';
    }


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function fieldMap() {
        return [
            'products_options_values_id' => 'id',
            'products_options_values_name' =>'name'
        ];
    }

}
