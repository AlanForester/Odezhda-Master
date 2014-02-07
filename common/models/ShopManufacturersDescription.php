<?php

/**
 * This is the model class for table "{{pages}}".
 *
 * The followings are the available columns in table '{{pages}}':
 * @property integer $pages_id
 * @property integer $language_id
 * @property string $pages_name
 * @property string $pages_description
 * @property integer $pages_viewed
 *
 */
class ShopManufacturersDescription extends LegacyActiveRecord {

    public function tableName() {
        return 'manufacturers_info';
    }

    /**
     * @return array карта полей бд (которые нужно перевернуть)
     */
    public function fieldMap() {
        return [
            //таблица описание товара
            'manufacturers_name' => 'manufacturers',
        ];
    }

    public function getRules() {
        return [
//            ['language_id', 'numerical', 'integerOnly' => true, 'message' => Yii::t('validation', 'Поле должно быть числовым')],
//            ['language_id', 'exist', 'allowEmpty' => false, 'className' => 'Language', 'attributeName' => 'languages_id', 'message' => Yii::t('validation', 'Неверное значение для поля')],
//            ['name', 'required', 'message' => Yii::t('validation', 'Название является обязательным')],
//            ['description', 'required', 'message' => Yii::t('validation', 'Описание является обязательным')],
        ];
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
