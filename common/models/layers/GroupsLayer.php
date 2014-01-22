<?php

class GroupsLayer {
    /**
     * @var array (поле БД => требуемое поле для модели)
     */
    private static $field_map = [
        'admin_groups_id' => 'id',
        'admin_groups_name' => 'name',
    ];

    /**
     * @param $row массив соответствий
     * @param bool $reverse конвертировать в прямую или обратную сторону(по умолчанию -  прямую)
     * @return mixed конвертированный по ключам массив
     *
     */
    private static function fieldMapConvert($row, $reverse = false) {
        // todo: вынести в наследуемый класс для прослоек функцию
        if (!$reverse) {
            foreach (self::$field_map as $k => $v) {
                $row[$v] = $row[$k];
                unset($row[$k]);
            }
        } else {
            foreach (self::$field_map as $k => $v) {
                $row[$k] = $row[$v];
                unset($row[$v]);
            }
        }

        return $row;
    }

    public static function getFieldName($field, $direct = true) {
        if ($direct) {
            // old => new
            return (array_key_exists($field, self::$field_map) ? self::$field_map[$field] : $field);
        } else {
            // new => old
            return (array_search($field, self::$field_map) ? : $field);
        }
    }

    public static function getList() {
        $result = [];
        $list = GroupLegacy::model()->findall();
        foreach ($list as $val) {
            $result[] = self::fieldMapConvert($val->attributes);
        }

        return $result;
    }


    public static function getListAndParams($data) {
        $result = [];
        $list = GroupLegacy::model()->findall(new CDbCriteria($data));
        foreach ($list as $val) {
            $result[] = self::fieldMapConvert($val->attributes);
        }

        return $result;
    }


}