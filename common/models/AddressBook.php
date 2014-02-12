<?php

/**
 * Модель управления таблицей адресной книгой.
 */
class AddressBook extends LegacyActiveRecord {

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        return 'address_book';
    }

    public function fieldMap() {
        return [
            'address_book_id' => 'id',
            'entry_gender' => 'gender',
            'entry_company' => 'company',
            'entry_firstname' => 'firstname',
            'entry_lastname' => 'lastname',
            'otchestvo' => 'middlename',
            'birth_day' => 'dob',//day of birth
            'pasport_seria' => 'passport_serie',
            'pasport_nomer' => 'passport_number',
            'pasport_kem_vidan' => 'passport_issue_organization',
            'pasport_kogda_vidan' => 'passport_issue_date',
            'entry_street_address' => 'street_address',
            'entry_suburb' => 'suburb',
            'entry_postcode' => 'postcode',
            'entry_city' => 'city',
            'entry_state' => 'state',
            'entry_country_id' => 'country_id',
            'entry_zone_id' => 'zone_id',
        ];
    }

    /**
     * Правила проверки полей модели
     *
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
    public function getRules() {
        return [

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
            'gender' => Yii::t('labels', 'Пол'),
            'firstname' => Yii::t('labels', 'Имя'),
            'middlename' => Yii::t('labels', 'Отчество'),
            'lastname' => Yii::t('labels', 'Фамилия'),
            'dob' => Yii::t('labels','Дата рождения'),
            'company' => Yii::t('labels', 'Компания'),

            'passport_serie' => Yii::t('labels', 'Серия паспорта'),
            'passport_number' => Yii::t('labels','Номер паспорта'),
            'passport_issue_organization' => Yii::t('labels','Организация, выдавшая паспорт'),
            'passport_issue_date' => Yii::t('labels','Дата выдачи паспорта'),

            'street_address' => Yii::t('labels', 'Адрес'),
            'suburb' => Yii::t('labels', 'Район города'),
            'city' => Yii::t('labels', 'Город'),
            'postcode' => Yii::t('labels', 'Почтовый индекс'),
            'state' => Yii::t('labels', 'Регион'),
            'country_id' => Yii::t('labels', 'Страна'),
            //'zone_id' => Yii::t('labels', '?'),
        ];
    }

    public function relations() {
        return [
            //'default_address' => [self::BELONGS_TO, 'Customer', 'default_address_id', 'together' => true],
            //'delivery_address' => [self::BELONGS_TO, 'Customer', 'delivery_address_id', 'together' => true],
            //'pay_address' => [self::BELONGS_TO, 'Customer', 'pay_address_id', 'together' => true],
        ];
    }

    public function behaviors() {
        return [
            'withRelated' => array(
                'class' => 'common.extensions.behaviors.WithRelatedBehavior',
            ),
        ];
    }

    public function defaultScope() {
        return [
            'with' => [
                //'default_address',
                //'delivery_address',
                //'pay_address',
            ]
        ];
    }

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
