<?php

class ProductOldToNewOptions extends LegacyActiveRecord {

    public function tableName() {
        return 'products_to_new_options';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function fieldMap() {
        return [
        //    'products_options_values_id' => 'rel_old_id',
        //    'products_new_value_id' =>'rel_new_name'
        ];
    }

}
