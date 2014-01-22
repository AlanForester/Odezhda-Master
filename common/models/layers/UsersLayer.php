<?php

// todo: реализовать хранение сообщения/статуса ошибки
class UsersLayer {
    /**
     * @var array (поле БД => требуемое поле для модели)
     */
    protected static $field_map = [
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

    protected static $errors = [];

    /**
     * @param $row массив полей, которые нужно пропустить через карту
     * @param bool $reverse конвертировать в прямую (old=>new) или обратную(new=>old) сторону(по умолчанию -  прямую)
     *
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
     *
     * @param string $field исходное имя поля
     * @param bool $direct [опционально] направление проверки, true - old => new; false - new => old (По умолчанию true)
     *
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

    public static function getModel() {
        return UserLegacy::model();
    }

    /**
     * Обновление значения параметра пользователя
     *
     * @param array $data массив данных для изменяемому полю бд. ключи: id - первичный ключ,field - название изменяемого поля,
     * newValue - новое значение поля
     *
     * @return bool
     */
    public static function updateField($data) {
        // реальное имя поля
        $field = self::getFieldName($data['field'], false);
        $user_id = TbArray::getValue('id', $data, false); //(!empty($data['id']) ? $data['id'] : false);
        $value = TbArray::getValue('newValue', $data, false); //(!empty($data['newValue']) ? $data['newValue'] : false);

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
     *
     * @param array $data исходные данные из формы
     *
     * @return bool|array массив данных пользователя или false
     */
    public static function save($data) {
        $id = TbArray::getValue('id', $data); //isset($data['id']) ? $data['id'] : null;

        // модель пользователя
        $user = self::getUser($id, 'add');
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
        if ((!$id && !empty($data['password'])) || ($id && !empty($data['password']))) {
            $data['password'] = $user->encrypt_password($data['password']);

        } else {
            unset ($data['password']);
        }

        $data['modified'] = new CDbExpression('NOW()');

        // задаем значения, получаем реальные имена полей
        $user->setAttributes(self::fieldMapConvert($data, true), false);

        if (!$user->save()) {
            self::$errors = $user->getErrors();

            return false;
        }

        return self::fieldMapConvert($user->attributes);
        // сохраняем и переворачиваем в виртуальные данные
        //        return ($user->save() ? self::fieldMapConvert($user->attributes) : false);
    }

    public static function delete($id) {
        $user = self::getUser($id);
        if ($user) {
            return $user->delete();
        }

        return false;
    }

    /**
     * Модель пользователя
     *
     * @param int $id [опционально] id пользователя. если не указан, вернет массив пустых данных
     * @param string $scenario [опционально] сценарий пользователя
     *
     * @return UserLegacy
     */
    public static function getUser($id = null, $scenario = null) {
        return ($id ? UserLegacy::model()
                                ->findByPk($id) : new UserLegacy($scenario));
    }

    public static function findByPk($id, $params) {
        return UserLegacy::model()
                         ->findByPk($id, $params);
    }

    public static function findByAttributes($attributes) {
        return UserLegacy::model()
                         ->findByAttributes($attributes);
    }

    /**
     * Поиск пользователя по имени
     *
     * @param string $username имя пользователя (username)
     *
     * @return UserLegacy
     */
    public static function find($username) {
        return UserLegacy::model()
                         ->find(
                         [
                             'condition' => 'admin_email_address=:username',
                             'params' => [':username' => $username]
                         ]
        );
    }

    /**
     * Проверка логина и пароля
     *
     * @param string $username логин
     * @param string $password пароль
     *
     * @return int 0 - пользователь не найден, 1 - не правильный пароль, AR- найденный пользователь
     */
    public static function authenticate($username, $password) {
        $user = self::find($username);
        if (!$user)
            return 0;
        //$this->failureBecauseUserNotFound();
        if (!$user->verifyPassword($password))
            return 1;

        //$this->failureBecausePasswordInvalid();

        return $user;
        //$this->makeAuthenticated($user);

        //return $this->isAuthenticated;
    }

    public static function makeAuthenticated($user) {
        $user->regenerateValidationKey();
        //        $this->id = User::getUserId($user);
        //        $this->username = User::getUserName($user);
        //        $this->setState('vkey', $user->validation_key);
        //        $this->errorCode = self::ERROR_NONE;

        return [
            'id' => $user->admin_id,
            'username' => $user->admin_email_address,
            'validation_key' => '' //$user->validation_key
        ];
    }

    public static function getUserName($model) {
        return $model->admin_email_address;
    }

    public static function getUserId($model) {
        return $model->admin_id;
    }

    public static function validate($attributes = null, $clearErrors = true) {
        //        $model = self::getUser();
        //        $model->setAttributes(self::fieldMapConvert($attributes, true));
        return UserLegacy::model()
                         ->validate($attributes, $clearErrors);
        //        return UserLegacy::validate($attributes,$clearErrors);
    }

    public static function getErrors($attributes = null) {
        //        print_r(UserLegacy::model());exit;
        //        return UserLegacy::model()->getErrors($attributes);
        return self::$errors;
    }

    /**
     * данные для валидации для внешнего использования
     */
    public static function rules() {
        $rules = UserLegacy::model()
                           ->rules();
        foreach ($rules as &$r) {
            $r[0] = join(
                ',',
                array_map(
                    function ($el) {
                        return self::getFieldName(trim($el));
                    }, explode(',', $r[0])
                )
            );
        }

        return $rules;
    }
}