<?php

class ShopCategoriesLayer {
    /**
     * @var array (поле БД => требуемое поле для модели)
     */
    private static $field_map = [
        'categories_id' => 'id',
        'categories_image' => 'image',
        'date_added' => 'added',
        'categories_status' => 'status',
        'last_modified' => 'modified',
//        'admin_password' => 'password',
//        'admin_created' => 'created',
        'categories_name' => 'name',
        'categories_heading_title' => 'heading_title',
        'categories_description' => 'description',
        'categories_meta_title' => 'meta_title',
        'categories_meta_description' => 'meta_description',
        'categories_meta_keywords' => 'meta_keywords',
        //

    ];

    private static $errors = [];

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

    /**
     * Ищем по id родительской категории записи в связанных таблицах бд
     * @param $id родительской категории
     * @return array массив данных из связанных табиц
     */
    public static function findByParentId($id){
        $result = [];
        $list = ShopCategoriesLegacy::model()->with('description')->findAllByAttributes(array('parent_id' => $id));
        //print_r($list);exit;
        foreach ($list as $val) {
            $result[] = array_merge(self::fieldMapConvert($val->attributes), self::fieldMapConvert($val->description->attributes));
        }
        return $result;
    }



    public static function getList($data=null) {
        $result = [];

        if ($data){
            $list = ShopCategoriesLegacy::model()->findall(new CDbCriteria($data));
            foreach ($list as $val) {
                $result[] = self::fieldMapConvert($val->attributes);
            }
        } else{
            $list = ShopCategoriesLegacy::model()->findall();
            foreach ($list as $val) {
                $result[] = self::fieldMapConvert($val->attributes);
            }
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
            $user = self::getCategory($user_id);
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
        $user = self::getCategory($id, 'add');
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

            // проверяем на уникальность email
//            if (UserLayer::find($data['email'])){
//                return false;
//            }

            $data['created'] = new CDbExpression('NOW()');
        }

        //$validPassField=(!$id && !empty($data['password']));
        // новый пользователь или новый пароль
        if ((!$id && !empty($data['password'])) || ($id && !empty($data['password']))) {
            $data['password'] = $user->encrypt_password($data['password']);

        } else {
            unset ($data['password']);
        }

        $data['modified'] = new CDbExpression('NOW()');

        // задаем значения, получаем реальные имена полей
        $user->setAttributes(self::fieldMapConvert($data, true), false);

        if (!$user->save()){
            self::$errors = $user->getErrors();
            return false;
        }

        return self::fieldMapConvert($user->attributes);
        // сохраняем и переворачиваем в виртуальные данные
//        return ($user->save() ? self::fieldMapConvert($user->attributes) : false);
    }


    public static function delete($id) {
        $parent = self::getCategory($id);
        //print_r($parent);exit;
        if (!($parent && $parent->delete())) {
            return false;
        } else {
            $children=self::findByParentId($id);
            foreach($children as $val){
                $child=self::getCategory($val['id']);
                if (!($child && $child->delete())) {
                    return false;
                }
            }
            return true;
        }
    }

    /**
     * Модель категори
     * @param int $id [опционально] id категори. если не указан, вернет массив пустых данных
     * @param string $scenario [опционально] сценарий категори
     * @return ShopCategoriesLegacy
     */
    public static function getCategory($id = null, $scenario = null) {
        return ($id ? ShopCategoriesLegacy::model()->with('description')->findByPk($id) : new ShopCategoriesLegacy($scenario));
    }

    public static function findByPk($id, $params) {
        return ShopCategoriesLegacy::model()->findByPk($id, $params);
    }

    public static function findByAttributes($attributes) {
        return ShopCategoriesLegacy::model()->findByAttributes($attributes);
    }

//    /**
//     * Поиск пользователя по имени
//     * @param string $username имя пользователя (username)
//     * @return UserLegacy
//     */
//    public static function find($username) {
//        return ShopCategoriesLegacy::model()->find(
//            [
//                'condition' => 'admin_email_address=:username',
//                'params' => [':username' => $username]
//            ]
//        );
//    }

//    public static function validate($attributes = null, $clearErrors = true) {
////        $model = self::getUser();
////        $model->setAttributes(self::fieldMapConvert($attributes, true));
//        return UserLegacy::model()->validate($attributes,$clearErrors);
////        return UserLegacy::validate($attributes,$clearErrors);
//    }
//
    public static function getErrors($attributes = null){
//        print_r(UserLegacy::model());exit;
//        return UserLegacy::model()->getErrors($attributes);
        return self::$errors;
    }

    /**
     * данные для валидации для внешнего использования
     */
    public static function rules(){
        $rules = ShopCategoriesLayer::model()->rules();
        foreach ($rules as &$r){
            $r[0] = join(',' , array_map( function($el){ return self::getFieldName(trim($el));} , explode(',',$r[0])  ));
        }
        return $rules;
    }
}