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

    public function relations() {
        return [
            //связь с опциями
            'products_to_new_options' => array(self::HAS_MANY, 'ProductOldToNewOptions', 'products_options_values_id','through' => 'product_options', 'together' => true),
            'products_new_option_values' => array(self::HAS_MANY, 'ProductNewOptions', 'products_new_value_id', 'through' => 'products_to_new_options', 'together' => true)
        ];
    }

    public function defaultScope() {
        return [
            'with' => [
              //  'products_new_option_values'
            ]
        ];
    }

}
