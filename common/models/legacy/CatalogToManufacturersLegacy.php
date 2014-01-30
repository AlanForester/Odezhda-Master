<?php

/**
 * This is the model class for table "{{categories}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $categories_id
=
 *
 */
class CatalogToManufacturersLegacy extends CActiveRecord
{
    public $products_id;


    protected $_allData = [];

    public function tableName()
    {
            return 'products_to_manufacturers';
    }


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
