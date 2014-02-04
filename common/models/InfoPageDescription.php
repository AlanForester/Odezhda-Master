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
            'pages_name' => 'name',
            'sort_order' => 'sort_order',
            'pages_description' => 'description',
            'pages_viewed' => 'viewed',
        ];
    }
    //--------------------------------------
    /**
     * Правила проверки полей модели
     *
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
    public function getRules() {
        return [
            ['email', 'email', 'message' => Yii::t('validation', "Некорректный E-mail")],
            ['email', 'unique', 'message' => Yii::t('validation', "E-mail должен быть уникальным")],
            ['email', 'required', 'message' => Yii::t('validation', 'E-mail является обязательным')],
            ['firstname', 'required', 'message' => Yii::t('validation', 'Имя является обязательным')],
            ['lastname', 'default'],
            ['group_id', 'required', 'message' => Yii::t('validation', 'Группа является обязательной')],
            ['password', 'required', 'on' => 'add', 'message' => Yii::t('validation', 'Пароль является обязательным')]
        ];
    }

    public function relations() {
        return [
            'page_description' => [self::HAS_ONE, 'InfoPageDescription', 'pages_id'],
        ];
    }

    /**
     * Заголовки полей (поле=>заголовок)
     *
     * @return array
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('labels', 'ID'),
            'group_id' => Yii::t('labels', 'Группа'),
            'firstname' => Yii::t('labels', 'Имя'),
            'lastname' => Yii::t('labels', 'Фамилия'),
            'email' => Yii::t('labels', 'E-mail'),
            'password' => Yii::t('labels', ($this->scenario =='update'? 'Новый пароль' :'Пароль')),

            'viewed' => Yii::t('labels', 'Просмотры'),
            'modified' => Yii::t('labels', 'Изменена'),
            'added' => Yii::t('labels', 'Создана'),
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
//    public function search() {
//        $PARTIAL = true;
//
//        $criteria = new CDbCriteria;
//        $criteria->compare('id', $this->id);
//        $criteria->compare('username', $this->username, $PARTIAL);
//        $criteria->compare('email', $this->email, $PARTIAL);
//
//        return new CActiveDataProvider(get_class($this), compact('criteria'));
//    }

    /**
     * Generates a new validation key (additional security for cookie)
     */
//    public function regenerateValidationKey() {
//        $validation_key = md5(mt_rand() . mt_rand() . mt_rand());
//        //$this->saveAttributes(compact('validation_key'));
//    }

    /**
     * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     *
     * @param string $className
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
