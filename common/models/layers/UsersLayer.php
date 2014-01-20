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
    public static function fieldMapConvert($row, $reverse = false) {
        if (!$reverse) {
            foreach (self::$field_map as $k => $v) {
                if (array_key_exists($k, $row)) {
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
            return (array_key_exists($field, self::$field_map) ? self::$field_map[$field] : $field);
        } else {
            // new => old
            return (array_search($field, self::$field_map) ? : $field);
        }
    }

    public static function getList($data) {
        $result = [];

        $list = UserLegacy::model()->findall(new CDbCriteria($data));
        foreach ($list as $val) {
            $result[] = self::fieldMapConvert($val->attributes);
        }

        return $result;
    }

    /**
     * Обновление значения параметра пользователя
     * @param array $data массив данных для изменяемому полю бд. ключи: id - первичный ключ,field - название изменяемого поля,
     * newValue - новое значение поля
     * @return bool
     */
    public static function updateField($data) {
        // реальное имя поля
        $field = self::getFieldName($data['field'], false);
        $user_id = (!empty($data['id']) ? $data['id'] : false);
        $value = (!empty($data['newValue']) ? $data['newValue'] : false);

        // все все данные верны, сохраняем
        if ($user_id && $field && $value) {
            $user = self::getUser($user_id);
            $user->{$field} = $value;

            return $user->save(true, [$field]);
        }

        return false;
    }

    /**
     * Создание или обновление пользователя на основе данных из формы
     * @param array $data исходные данные из формы
     * @return bool|array массив данных пользователя или false
     */
    public static function save($data) {
        $id = isset($data['id']) ? $data['id'] : null;

        // модель пользователя
        $user = self::getUser($id);
        if (!$user) {
            return false;
        }

        if ($id) {
            // обновление пользователя

        } else {
            // если есть пустой id в параметрах - удаяем
            if (array_key_exists('id', $data)) {
                unset($data['id']);
            }

            $data['created'] = new CDbExpression('NOW()');
        }

        // новый пользователь или новый пароль
        if (!$id || isset($data['password'])) {
            $data['password'] = $user->encrypt_password($data['password']);
        }
        $data['modified'] = new CDbExpression('NOW()');

        // задаем значения, получаем реальные имена полей
        $user->setAttributes(self::fieldMapConvert($data, true), false);

        // сохраняем и переворачиваем в виртуальные данные
        return ($user->save(false) ? self::fieldMapConvert($user->attributes) : false);
    }

    /**
     * Модель пользователя
     * @param int $id [опционально] id пользователя. если не указан, вернет массив пустых данных
     * @return UserLegacy
     */
    public static function getUser($id = null) {
        return ($id ? UserLegacy::model()->findByPk($id) : new UserLegacy);
    }
}