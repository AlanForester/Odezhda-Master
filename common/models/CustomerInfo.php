<?php

/**
 * Модель управления таблицей информации о клиентах.
 */
class CustomerInfo extends LegacyActiveRecord {

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        return 'customers_info';
    }

    public function fieldMap() {
        return [
            'customers_info_id' => 'id',
            'customers_info_date_of_last_logon' => 'last_logon',
            'customers_info_number_of_logons' => 'logon_count',
            'customers_info_date_account_created' => 'created',
            'customers_info_date_account_last_modified' => 'modified',
            //'global_product_notifications' => 'global_product_notifications',
        ];
    }

    /**
     * Правила проверки полей модели
     *
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
    /*public function getRules() {
        return [
            ['modified','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'edit'],
            ['created, modified','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'add']
        ];
    }*/

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class'=>'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate'=>true,
                'createAttribute'=>'customers_info_date_account_created',
                'updateAttribute'=>'customers_info_date_account_last_modified',
            ),
        );
    }

    /**
     * Заголовки полей (поле=>заголовок)
     *
     * @return array
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('labels', 'ID'),
            'last_logon' => Yii::t('labels', 'Последний визит'),
            'logon_count' => Yii::t('labels', 'Кол-во авторизаций'),
            'created' => Yii::t('labels', 'Создан'),
            'modified' => Yii::t('labels', 'Изменен'),
            //'global_product_notifications' => Yii::t('labels', '?'),
        ];
    }

    public function relations() {
        return [

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
