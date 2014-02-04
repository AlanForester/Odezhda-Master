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
class InfoPageDescription extends LegacyActiveRecord {

    public function tableName() {
        return 'pages_description';
    }

    /**
     * @return array карта полей бд (которые нужно перевернуть)
     */
    public function fieldMap() {
        return [
            'pages_id' => 'id',
            'pages_name' => 'name',
            'pages_description' => 'description',
            'pages_viewed' => 'viewed',
        ];
    }

    /**
     * Правила проверки полей модели
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
    public function getRules() {
        return [
            ['language_id', 'numerical', 'integerOnly' => true, 'message'=>Yii::t('validation', 'Поле должно быть числовым')],
            ['language_id', 'exist', 'allowEmpty'=>false,'className'=>'Language', 'attributeName' => 'languages_id', 'message'=>Yii::t('validation', 'Неверное значение для поля')],
            ['name', 'required', 'message' => Yii::t('validation', 'Название является обязательным')],
            ['description', 'required', 'message' => Yii::t('validation', 'Описание является обязательным')],
        ];
    }

    public function relations() {
        return [
            'page_description' => [self::HAS_ONE, 'InfoPageDescription', 'pages_id'],
        ];
    }

    /**
     * Заголовки полей (поле=>заголовок)
     * @return array
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('labels', 'ID'),
            'language_id' => Yii::t('labels', 'Язык'),
            'pages_name' => Yii::t('labels', 'Название'),
            'pages_description' => Yii::t('labels', 'Описание'),
            'pages_viewed' => Yii::t('labels', 'Количество просмотров'),
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
