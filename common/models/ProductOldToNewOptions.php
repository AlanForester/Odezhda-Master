<?php

class ProductOldToNewOptions extends LegacyActiveRecord {


    public function tableName() {
        return 'products_to_new_options';
    }


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
