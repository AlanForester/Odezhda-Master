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
//    public $categories_id;
//    public $language_id;
//    public $categories_name;
//    public $categories_heading_title;
//    public $categories_description;
//    public $categories_meta_title;
//    public $categories_meta_description;
//    public $categories_meta_keywords;

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
//    public function relations()
//    {
//        return array(
//            'categories'=>array(self::HAS_ONE, 'ShopCategoriesLegacy', 'categories_id'),
//        );
//    }

    public function rules()
    {
        return [
            ['language_id', 'numerical', 'integerOnly' => true, 'message'=>Yii::t('validation', 'Поле должно быть числовым')],
            ['language_id', 'exist', 'allowEmpty'=>false,'className'=>'Language', 'attributeName' => 'languages_id', 'message'=>Yii::t('validation', 'Неверное значение для поля')],
            ['categories_name', 'required', 'message' => Yii::t('validation', 'Название является обязательным')],
        ];
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
