<?php

/**
 * This is the model class for table "{{pages}}".
 *
 * The followings are the available columns in table '{{pages}}':
 * @property integer $pages_id
 * @property string $pages_image
 * @property integer $sort_order
 * @property datetime $pages_date_added
 * @property datetime $pages_last_modified
 * @property integer $pages_status

 *
 */
class InfoPage extends LegacyActiveRecord {

    public function tableName() {
        return 'pages';
    }

    /**
     * @return array карта полей бд (которые нужно перевернуть)
     */
    public function fieldMap() {
        return [
            'pages_id' => 'id',
            'pages_image' => 'image',
            'pages_date_added' => 'added',
            'pages_status' => 'status',
            'pages_last_modified' => 'modified',
            'sort_order' => 'sort_order',
        ];
    }
    //--------------------------------------
    /**
     * Правила проверки полей модели
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
    public function getRules() {
        return [
            ['sort_order', 'numerical', 'message' => Yii::t('validation', "Поле должно быть числовым")],
            ['status', 'boolean', 'message'=>Yii::t('validation', 'Неверное значение поля')],
            ['sort_order', 'length', 'max' => 3, 'message'=>Yii::t('validation', 'Слишком большое число (максимум 999)')],
        ];
    }

    /**
     * Заголовки полей (поле=>заголовок)
     * @return array
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('labels', 'ID'),
            'sort_order' => Yii::t('labels', 'Порядок сортирвки'),
            'status' => Yii::t('labels', 'Статус'),
            'modified' => Yii::t('labels', 'Изменена'),
            'added' => Yii::t('labels', 'Создана'),
            'image' => Yii::t('labels', 'Изображение'),
        ];
    }

    public function relations() {
        return [
            'page_description' => [self::HAS_ONE, 'InfoPageDescription', 'pages_id'],
        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     * @param string $className
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
