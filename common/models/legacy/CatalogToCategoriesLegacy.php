<?php

/**
 * This is the model class for table "{{categories}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $categories_id
=
 *
 */
class CatalogToCategoriesLegacy extends CActiveRecord
{
    public $products_id;

    //public $primaryKey='products_id';

    // здесь мы храним ВСЮ информацию, пришедшую на сохранение
    // и для основной таблице и для связанных
    protected $_allData = [];

    /**
     * Name of the database table associated with this ActiveRecord
     * @return string
     */
    public function tableName()
    {
            return 'products_to_categories';
    }


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

//    public function relations()
//    {
//        return array(
//            'description'=>array(self::HAS_ONE, 'CatalogDescriptionLegacy', 'products_id')
//        );
//    }

}
