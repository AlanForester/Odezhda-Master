<?php

class CatalogLayer {
    /**
     * @var array (поле БД => требуемое поле для модели)
     */
    private static $field_map = [
        'products_id' => 'id',
        'products_price' => 'price',
            'products_name' => 'name',
            'products_description' => 'description'

    ];

    public static $errors = [];
    /**
     * @param $row массив соответствий
     * @param bool $reverse конвертировать в прямую или обратную сторону(по умолчанию -  прямую)
     * @return mixed конвертированный по ключам массив
     *
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
        $list = CatalogLegacy::model()->findall();
        foreach ($list as $val) {
            $result[] = self::fieldMapConvert($val->attributes);
        }

        return $result;
    }


    public static function getListAndParams($data) {
//        $result = [];
//        print_r($data);
//        exit;
        $criteria = new CDbCriteria();
        $criteria->limit = 1000;
        $list = CatalogLegacy::model()->with('description')->findall($criteria);

        foreach ($list as $val) {
                $result[] = self::fieldMapConvert($val->attributes) + self::fieldMapConvert($val->description->attributes);
        }

//        foreach ($list->description->attributes as $val) {
//            $result[] = self::fieldMapConvert($val->attributes);
//        }

        return $result;
    }

    public static function getCatalogDescription($id = null, $scenario = null) {
        return ($id ? CatalogDescriptionLegacy::model()->findByPk($id) : new CatalogDescriptionLegacy($scenario));
    }

    public static function save($data) {

       // $id = TbArray::getValue('id', $data);
        $id=isset($data['id']) ? $data['id'] : null;
        //$id=$data['id'];
        // модель группы
        $Catalog = self::getCatalog($id, 'add');
        if (!$Catalog) {
            return false;
        }

        if ($id) {
            // обновление группы

        } else {
            // если есть пустой id в параметрах - удаяем
            if (array_key_exists('id', $data)) {
                unset($data['id']);
            }

        }




        // задаем значения, получаем реальные имена полей
        $Catalog->setAttributes(self::fieldMapConvert($data, true), false);



        if (!$Catalog->save()) {
            self::$errors = $Catalog->getErrors();
            return false;
        }


        return self::fieldMapConvert($Catalog->attributes);
        // сохраняем и переворачиваем в виртуальные данные
        //        return ($user->save() ? self::fieldMapConvert($user->attributes) : false);
    }



    public static function validate($attributes = null, $clearErrors = true) {
        //        $model = self::getUser();
        //        $model->setAttributes(self::fieldMapConvert($attributes, true));
        return CatalogLegacy::model()
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
        $rules = CatalogLegacy::model()
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

    public static function delete($id) {
        $Catalog = self::getCatalog($id);
        if ($Catalog) {
            return $Catalog->delete();
        }

        return false;
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
        $Catalog_id = TbArray::getValue('id', $data, false); //(!empty($data['id']) ? $data['id'] : false);
        $value = TbArray::getValue('newValue', $data, false); //(!empty($data['newValue']) ? $data['newValue'] : false);


        // все все данные верны, сохраняем
        if ($Catalog_id && $field && $value) {
            $Catalog = self::getCatalogDescription($Catalog_id);

            echo '<pre>';
            print_r($Catalog);
            exit;


            $Catalog->{$field} = $value;

            return $Catalog->save(true, [$field]);
        }

        return false;
    }
}