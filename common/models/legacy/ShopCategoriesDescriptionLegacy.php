<?php

/**
 * This is the model class for table "{{categories_description}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $categories_id
 * @property integer $language_id
 * @property string $categories_name
 * @property string $categories_heading_title
 * @property string $categories_description
 * @property string $categories_meta_title
 * @property string $categories_meta_description
 * @property string $categories_meta_keywords

 *
 */
class ShopCategoriesDescriptionLegacy extends CActiveRecord
{
    public $primaryKey='categories_id';

    /**
     * Name of the database table associated with this ActiveRecord
     * @return string
     */
    public function tableName()
    {
        return 'categories_description';
    }

    /**
     * Связь с таблицей categories
     * @return array
     */
    public function relations()
    {
        return array(
            'categories'=>array(self::HAS_ONE, 'ShopCategoriesLegacy', 'categories_id'),
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     *
     * @param string $className
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
