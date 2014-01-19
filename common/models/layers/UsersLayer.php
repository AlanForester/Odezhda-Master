<?php

class UsersLayer {
    /**
     * @var array (поле БД => требуемое поле для модели)
     */
    private static $field_map = [
        'admin_id' => 'id',
        'admin_groups_id' => 'group_id',
        'admin_firstname' => 'firstname',
        'admin_lastname' => 'lastname',
        'admin_email_address' => 'email',
        'admin_password' => 'password',
        'admin_created' => 'created',
        'admin_modified' => 'modified',
        'admin_logdate' => 'logdate',
        'admin_lognum' => 'lognum',
        'admin_cat_access' => 'cat_access',
        'admin_right_access' => 'right_access',
    ];

    /**
     * @param $row массив полей, которые нужно пропустить через карту
     * @param bool $reverse конвертировать в прямую (old=>new) или обратную(new=>old) сторону(по умолчанию -  прямую)
     * @return mixed конвертированный по ключам массив
     */
    private static function fieldMapConvert($row, $reverse = false) {
        if (!$reverse) {
            foreach (self::$field_map as $k => $v) {
                if (isset ($row[$k])) {
                    $row[$v] = $row[$k];
                    unset($row[$k]);
                }
            }
        } else {
            foreach (self::$field_map as $k => $v) {
                if (isset ($row[$v])) {
                    $row[$k] = $row[$v];
                    unset($row[$v]);
                }
            }
        }

        return $row;
    }

    /**
     * Конвертировать имя поля для старой или новой таблице
     * @param string $field исходное имя поля
     * @param bool $direct [опционально] направление проверки, true - old => new; false - new => old (По умолчанию true)
     * @return string
     */
    public static function getFieldName($field, $direct = true) {
        if ($direct) {
            // old => new
            return (isset(self::$field_map[$field]) ? self::$field_map[$field] : $field);
        } else {
            // new => old
            return (array_search($field, self::$field_map) ? : $field);
        }
    }

    public static function usersList($data) {
        $result = [];

        $list = UserLegacy::model()->findall(new CDbCriteria($data));
        foreach ($list as $val) {
            $result[] = self::fieldMapConvert($val->attributes);
        }

        return $result;
    }

    /**
     * @param $params массив данных по изменяемому полю бд. ключи: id - первичный ключ,field - название изменяемого поля,
     * newValue - новое значение поля
     * @return bool
     */
    public static function changeField($params) {
        $convertField = array_search($params['field'], self::$field_map);
        if (!empty($params['id']) && $convertField && !empty($params['newValue'])) {
            $find = UserLegacy::model()->findByPk($params['id']);
            //$find=UserLegacy::model()->find("admin_id = :admin_id", array("admin_id" => $params['id'] ));
            $find->{$convertField} = $params['newValue'];
            //todo изменить AR под свою таблицу (иначе необходимо запрещать валидацию в save)qq
            if ($find->save(true, [$convertField])) //$find->save(false) : false запрещает валидацию
                return true;
            else
                return false;
            //          UserLegacy::model()->updateAll([$convertField => $params['newValue']],"admin_id = :admin_id", array("admin_id" => $params['id'] ));
            //          return true;
        } else
            return false;
    }

    public static function changeUser($params = []) {
        $convertFields = self::fieldMapConvert($params, true);
        if (!empty($params) && !empty($convertFields['admin_id'])) {
            $find = UserLegacy::model()->findByPk($params['id']);

            if (empty($convertFields['admin_password']))
                unset ($convertFields['admin_password']);
            else
                $convertFields['admin_password'] = $find->encrypt_password($convertFields['admin_password']);
            $find->setAttributes($convertFields, false);
            //print_r($find);exit;
            //todo изменить AR под свою таблицу (иначе необходимо запрещать валидацию в save)
            if ($find->save(false)) //$find->save(false) : false запрещает валидацию
                return true;
            else
                return false;
        } else
            return false;
    }

    public static function addUser($params = []) {
        $convertFields = self::fieldMapConvert($params, true);
        if (!empty($params)) {
            $newUser=new UserLegacy;
            $convertFields['admin_password'] = $newUser->encrypt_password($convertFields['admin_password']);
            $newUser->admin_created=new CDbExpression('NOW()');
            $newUser->admin_modified=new CDbExpression('NOW()');
            $newUser->setAttributes($convertFields, false);
            //print_r($newUser);exit;
            //todo изменить AR под свою таблицу (иначе необходимо запрещать валидацию в save)
            if ($newUser->save(false)) //$find->save(false) : false запрещает валидацию
                return true;
            else
                return false;
        } else
            return false;
    }

    public static function getUserById($userId) {
        if (!empty($userId)) {
            $result = UserLegacy::model()->findByPk($userId);
            if ($result) {
                $result = self::fieldMapConvert($result->attributes);
                return $result;
            } else
                return false;
        } else
            return false;
    }
}