<?php

class Language extends CActiveRecord {

    public $primaryKey = 'languages_id';

    public $list=[];
    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        return 'languages';
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

    public function getList() {
        if (!$this->list) {
            $languages = $this->findAll();
            foreach ($languages as $val) {
                $this->list[] = $val->attributes;
            }

        }
//        print_r($this->list);exit;
        return $this->list;
    }

}
