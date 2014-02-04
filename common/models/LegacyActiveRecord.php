<?php

abstract class LegacyActiveRecord extends CActiveRecord {

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
}