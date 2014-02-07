<?php

class CustomersHelper {

    protected static $errors = [];


    public static function getModel() {
        return Customer::model();
    }

    /**
     * Модель пользователя
     * @param int $id [опционально] id пользователя. если не указан, вернет массив пустых данных
     * @param string $scenario [опционально] сценарий пользователя
     * @return User
     */
    public static function getUser($id = null, $scenario = null) {
        $model = self::getModel();
        return ($id ? $model->findByPk($id) : new $model($scenario));

        //        return ($id ? UserLegacy::model()->findByPk($id) : new UserLegacy($scenario));
    }

    //    public static function findByPk($id, $params) {
    //        return UserLegacy::model()
    //            ->findByPk($id, $params);
    //    }
    //

    /**
     * Найти пользователя по заданным параметрам
     * @param array $attributes атрибут и их значения
     * @return CActiveRecord
     */
    public static function findByAttributes($attributes) {
        return self::getModel()->findByAttributes($attributes);
//        return CustomersHelper::getModel()->findByAttributes($attributes);
    }


    /**
     * Проверка логина и пароля
     * @param string $username логин
     * @param string $password пароль
     * @return int 0 - пользователь не найден, 1 - не правильный пароль, AR- найденный пользователь
     */
    public static function authenticate($username, $password) {
        //        $user = self::find($username);
        //        $user = self::findByAttributes(['[[email]]' => $username]);

        if (!$user = self::findByAttributes(['email' => $username])) {
            return 0;
        }

        //$this->failureBecauseUserNotFound();
        if (!$user->verifyPassword($password)) {
            return 1;
        }

        //$this->failureBecausePasswordInvalid();

        return $user;
        //$this->makeAuthenticated($user);

        //return $this->isAuthenticated;
    }

    public static function makeAuthenticated($user) {
//        $user->regenerateValidationKey();
        //        $this->id = User::getUserId($user);
        //        $this->username = User::getUserName($user);
        //        $this->setState('vkey', $user->validation_key);
        //        $this->errorCode = self::ERROR_NONE;

        return [
            'id' => $user->id,
            'username' => $user->email,
            'validation_key' => '' //$user->validation_key
        ];
    }

    //    public static function getUserName($model) {
    //        return $model->admin_email_address;
    //    }

    //    public static function getUserId($model) {
    //        return $model->admin_id;
    //    }

    //    public static function validate($attributes = null, $clearErrors = true) {
    //        //        $model = self::getUser();
    //        //        $model->setAttributes(self::fieldMapConvert($attributes, true));
    //        return UserLegacy::model()
    //            ->validate($attributes, $clearErrors);
    //        //        return UserLegacy::validate($attributes,$clearErrors);
    //    }

    public static function getErrors($attributes = null) {
        //        print_r(UserLegacy::model());exit;
        //        return UserLegacy::model()->getErrors($attributes);
        return self::$errors;
    }

    /**
     * данные для валидации для внешнего использования
     */
    //    public static function rules() {
    //        $rules = UserLegacy::model()
    //            ->rules();
    //        foreach ($rules as &$r) {
    //            $r[0] = join(
    //                ',',
    //                array_map(
    //                    function ($el) {
    //                        return self::getFieldName(trim($el));
    //                    }, explode(',', $r[0])
    //                )
    //            );
    //        }
    //
    //        return $rules;
    //    }

    // -----------------------------------

    public static function getDataProvider($data = null) {
        $condition = [];
        $params = [];

        // фильтр по тексту
        if (!empty($data['text_search'])) {
            $condition[] = '(' . join(
                    ' OR ',
                    [
                        '[[firstname]] LIKE :text',
                        '[[lastname]] LIKE :text',
                        '[[email]] LIKE :text',
                        '[[id]] LIKE :text'
                    ]
                ) . ')';

            $params[':text'] = '%' . $data['text_search'] . '%';
        }

        // фильтр по группе
        if (!empty($data['filter_groups'])) {
            $condition[] = '[[group_id]]=:group';
            $params[':group'] = $data['filter_groups'];
        }

        // фильтр по дате создания
        if (!empty($data['filter_created'])) {
            $range = $data['filter_created'];
            $date_start = new DateTime();
            $date_now = new DateTime();

            switch ($range) {
                case 'past_week':
                    $date_start->modify('-7 day');
                    break;

                case 'past_1month':
                    $date_start->modify('-1 month');
                    break;

                case 'past_3month':
                    $date_start->modify('-3 month');
                    break;

                case 'past_6month':
                    $date_start->modify('-6 month');
                    break;

                case 'post_year':
                case 'past_year':
                    $date_start->modify('-1 year');
                    break;

                case 'today':
                    $date_now->modify('+1 day');
                    break;
            }

            if ($range == 'post_year') {
                $condition[] = '[[created]] < :date_start';
            } else {
                $condition[] = '([[created]] >= :date_start AND [[created]] <= :date_now)';
                $params[':date_now'] = $date_now->format('Y-m-d');
            }

            $params[':date_start'] = $date_start->format('Y-m-d');
        }

        // поле и направление сортировки
        $order_direct = null;
        $order_field = '[[' . (!empty($data['order_field']) ? $data['order_field'] : 'firstname') . ']]';

        if (isset($data['order_direct'])) {
            switch ($data['order_direct']) {
                case 'up':
                    $order_direct = ' ASC';
                    break;
                case 'down':
                    $order_direct = ' DESC';
                    break;
            }
        }

        $page_size = TbArray::getValue('page_size', $data, CPagination::DEFAULT_PAGE_SIZE);

        $criteria = [
            'condition' => join(' AND ', $condition),
            'params' => $params,
            'order' => $order_field . ($order_direct ? : ''),
        ];

        // разрешаем перезаписать любые параметры критерии
        if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }

        return new CActiveDataProvider(
            'User',
            [
                'criteria' => $criteria,
                'pagination' => ($page_size == 'all' ? false : ['pageSize' => $page_size]),
            ]
        );
    }

    /**
     * Создание пользователя на основе данных из формы
     * @param array $data исходные данные из формы
     * @return bool|array массив данных пользователя или false
     */
    public static function save($data) {
        print_r($data);exit;
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
        $user->setAttributes($data, false);
        //        $user->setAttributes(self::fieldMapConvert($data, true), false);
        //print_r($user);exit;
        if (!$user->save()) {
            self::$errors = $user->getErrors();

            return false;
        }

        return $user; //->attributes;
        //        return self::fieldMapConvert($user->attributes);

        // сохраняем и переворачиваем в виртуальные данные
        //        return ($user->save() ? self::fieldMapConvert($user->attributes) : false);
    }
}