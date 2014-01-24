<?php

/**
 * This is the model class for table "{{categories}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $categories_id
=
 *
 */
class CatalogToCategoryLegacy extends CActiveRecord
{
    public $products_id;


    public $primaryKey='products_id';


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
    public function relations()
    {
        return array(
            'catalog_category'=>array(self::MANY_MANY, 'CatalogToCategory', 'products_id'),
        );
    }
}
