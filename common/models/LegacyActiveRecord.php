<?php

abstract class LegacyActiveRecord extends CActiveRecord {

    /**
     * attribute name => attribute value
     * Необходимо для populateRecord()
     */
//    private $_attributes=array();

    // todo: временно не используется
    public $withRealation = false;

    public function __get($name) {
        return parent::__get($this->getFieldMapName($name, false));
    }

    public function __set($name, $value) {
        parent::__set($this->getFieldMapName($name, false), $value);
    }

    public function __isset($name) {
        return parent::__isset($this->getFieldMapName($name, false));
    }

    public function __unset($name) {
        parent::__unset($this->getFieldMapName($name, false));
    }

    /**
     * Конвертировать имя поля для старой или новой таблице
     * @param string $field исходное имя поля
     * @param bool $direct [опционально] направление проверки, true - old => new; false - new => old (По умолчанию true)
     * @return string
     */
    public function getFieldMapName($field, $direct = true) {
        $map = $this->fieldMap();

        if ($direct) {
            // old => new
            return (array_key_exists($field, $map) ? $map[$field] : $field);
        } else {
            // new => old
            return (array_search($field, $map) ? : $field);
        }
    }

    /**
     * Конвертировать массив полей
     * @see getFieldMapName
     * @param $fields массив полей
     * @param bool $direct направление проверки
     * @return mixed массив с замененными по карте значениями
     */
    public function getFieldMapArray($fields, $direct = true) {

        if ($fields) {
            foreach ($fields as $n => $f) {
                $fields[$n] = $this->getFieldMapName($f, $direct);
            }
        }

        return $fields;
    }

    /**
     * Конвертировать массив, в котором ключи необходимо перевернуть
     * @see getFieldMapName
     * @param $fields массив полей
     * @param bool $direct направление проверки
     * @return mixed массив с замененными по карте значениями
     */
    public function getFieldMapArrayKeys($fields, $direct = true) {

        if ($fields) {
           $result=[];
            foreach ($fields as $n => $f) {
                $result[$this->getFieldMapName($n, $direct)]=$f;
            }
        }
        return $result;
    }

    /**
     * Замена имени поля в подстроке по маске "[[new]]" => "old"
     * @param mixed $data исходные данные. может быть массивом, обьектом или строкой
     * @return mixed
     */
    public function getFieldMapQuery($data) {
        switch (gettype($data)) {
            case 'array':
            case 'object':
                foreach ($data as &$d) {
                    $d = $this->getFieldMapQuery($d);
                }
                break;

            case 'string':
                $data = preg_replace_callback(
                    '/(\[\[(.*)\]\])/isU',
                    function ($m) {
                        return $this->getFieldMapName($m[2], false);
                    },
                    $data
                );
                break;

        }

        return $data;
    }

    /**
     * Карта название полей, вида "реальное поле бд" (old) => "используемое системой" (new)
     * @return array
     */
    public function fieldMap() {
        return [];
    }

    public function save($runValidation = true, $attributes = null) {
        return parent::save($runValidation, $this->getFieldMapArray($attributes, false));
    }

    protected function query($criteria, $all = false) {
        return parent::query($this->getFieldMapQuery($criteria), $all);
    }

    public function count($condition = '', $params = []) {
        return parent::count($this->getFieldMapQuery($condition), $params);
    }

    public function setAttributes($values, $safeOnly = true) {
        foreach ($values as $key => $val) {
            $tmp = $this->getFieldMapName($key, false);
            if ($tmp != $key) {
                $values[$tmp] = $val;
                unset($values[$key]);
            }
        }
        parent::setAttributes($values, $safeOnly);
    }

    /**
     * Правила проверки полей модели. Данная функция должна вернуть массив правил,
     * который раньше отдавался функцией rules()
     * @return array
     */
    public function getRules() {
        return [];
    }

    /**
     * Перекрытие стандартного метода получения прав проверки, с корректировкой имен полей
     * @return array
     */
    public function rules() {
        $rules = $this->getRules();
        // исправление некоторых имен полей, критичных для дальнешей работы с бд
        foreach ($rules as &$r) {
            if (isset($r[0], $r[1])) {
                if ($r[1] == 'unique') {
                    $r[0] = $this->getFieldMapName($r[0], false);
                }
            }
        }

        return $rules;
    }

    public function findByAttributes($attributes, $condition = '', $params = []) {
        foreach ($attributes as $key => $val) {
            $tmp = $this->getFieldMapName($key, false);
            if ($tmp != $key) {
                $attributes[$tmp] = $val;
                unset($attributes[$key]);
            }
        }
        return parent::findByAttributes($this->getFieldMapQuery($attributes), $condition, $params);
//        Yii::trace(get_class($this) . '.findByAttributes()', 'system.db.ar.CActiveRecord');
//        $prefix = $this->getTableAlias(true) . '.';
//        $criteria = $this->getCommandBuilder()->createColumnCriteria($this->getTableSchema(), $attributes, $condition, $params, $prefix);
//        return $this->query($criteria);
    }

    /**
     * todo: включить голову
     *
     * Перекрытие стандартного метода получения записей из бд при использовании find*
     * с корректировкой имен полей.
     * @param array $attributes attribute values (column name=>column value)
     * @param boolean $callAfterFind whether to call {@link afterFind} after the record is populated.
     * @return CActiveRecord the newly created active record. The class of the object is the same as the model class.
     * Null is returned if the input data is false.
     */
//    public function populateRecord($attributes,$callAfterFind=true)
//    {
//        if($attributes!==false)
//        {
//            $record=$this->instantiate($attributes);
//            $record->setScenario('update');
//            $record->init();
//            $md=$record->getMetaData();
//            foreach($attributes as $name=>$value)
//            {
//                $newName = $this->getFieldMapName($name, true);
//                if(property_exists($record,$name))
//                    $record->$newName=$value;
//                elseif(isset($md->columns[$name]))
//                    $record->_attributes[$newName]=$value;
//            }
//            $record->_pk=$record->getPrimaryKey();
//            $record->attachBehaviors($record->behaviors());
//            if($callAfterFind)
//                $record->afterFind();
//            return $record;
//        }
//        else
//            return null;
//    }
}