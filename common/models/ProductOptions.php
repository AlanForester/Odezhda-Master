<?php

class ProductOptions extends LegacyActiveRecord {


    public function tableName() {
        return 'products_new_options_values';
    }


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
