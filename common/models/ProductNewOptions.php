<?php

class ProductNewOptions extends LegacyActiveRecord {


    public function tableName() {
        return 'products_new_option_values';
    }


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
