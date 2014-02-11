<?php

/**
 * Модель управления таблицей категорий клиентов.
 */
class CustomerGroups extends LegacyActiveRecord {

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        return 'customers_groups';
    }

    public function fieldMap() {
        return [
            'customers_groups_id' => 'id',
            'customers_groups_name' => 'name',
            'customers_groups_discount' => 'discount',
            'customers_groups_price' => 'price',
            'customers_groups_accumulated_limit' => 'accumulated_limit',
            'customers_groups_min_price' => 'min_price',
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
            'name' => Yii::t('labels', 'Название'),
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
