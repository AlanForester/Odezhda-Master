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
    private static $dataProvider;

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
    public static function findByParentId($id) {
        $result = [];
        $list = ShopCategoriesLegacy::model()->findAllByAttributes(array('parent_id' => $id));
        foreach ($list as $val) {
            $result[]=array_merge(self::fieldMapConvert($val->getAttributes()), ($val->description ? self::fieldMapConvert($val->description->getAttributes()) : []));
        }
//        print_r($result);exit;
        return $result;
    }

    public static function getCategoriesList($id=0) {
        $result = [];
        $list = ShopCategoriesLegacy::model()->findall();
        foreach ($list as $val) {
            if ($val->description){
                $result[] = array_merge(self::fieldMapConvert($val->getAttributes(['categories_id', 'parent_id'])), self::fieldMapConvert($val->description->getAttributes(['categories_name'])));
            }
        }

        $result=self::buildTree($result);
//        print_r($result);exit;
        $result=self::flatTree(['data'=>$result]);
        $result = array_map(function($el){return (array)$el;},$result);
        return $result;
    }

    public static function getList($data, $relatedData) {
        $result = [];
//        print_r($relatedData);exit;
        $data=array_merge($data, ['with'=>['description'=>$relatedData]]);
        $criteria = new CDbCriteria($data);
//        print_r(new CDbCriteria($data));exit;
        $list = ShopCategoriesLegacy::model()->findAll($criteria);
        foreach ($list as $val) {
            $result[] = array_merge(self::fieldMapConvert($val->description->getAttributes()), self::fieldMapConvert($val->getAttributes()));
        }

        return $result;
    }

    public static function getActiveProvider($data)  {
        if (!$dataProvider) {
//            print_r($data);exit;
            // todo: переместить все в прослойку
            $condition = [];
            $params = [];

            $relatedCondition= [];
            $relatedParams = [];

            // фильтр по тексту
            if (!empty($data['text_search'])) {
                $relatedCondition[] = '(' . join(
                        ' OR ',
                        [
                            'description.'.self::getFieldName('name', false) . ' LIKE :text',
//                            ShopCategoriesLayer::getFieldName('lastname', false) . ' LIKE :text',
//                            ShopCategoriesLayer::getFieldName('email', false) . ' LIKE :text',
//                            ShopCategoriesLayer::getFieldName('id', false) . ' LIKE :text'
                        ]
                    ) . ')';

                $relatedParams[':text'] = '%' . $data['text_search'] . '%';
            }


            // фильтр по родительской категории
            if (!empty($data['filter_categories']) || $data['filter_categories']==='0') {//вторая проверка для случая, когда parent_id=0
                $condition[] = self::getFieldName('parent_id', false) . '=:category';
                $params[':category'] = $data['filter_categories'];
            }

            // фильтр по дате создания
//            if (!empty($data['filter_created'])) {
//                $range = $data['filter_created'];
//                $date_start = new DateTime();
//                $date_now = new DateTime();
//
//                switch ($range) {
//                    case 'past_week':
//                        $date_start->modify('-7 day');
//                        break;
//
//                    case 'past_1month':
//                        $date_start->modify('-1 month');
//                        break;
//
//                    case 'past_3month':
//                        $date_start->modify('-3 month');
//                        break;
//
//                    case 'past_6month':
//                        $date_start->modify('-6 month');
//                        break;
//
//                    case 'post_year':
//                    case 'past_year':
//                        $date_start->modify('-1 year');
//                        break;
//
//                    case 'today':
//                        $date_now->modify('+1 day');
//                        break;
//                }
//
//                if ($range == 'post_year') {
//                    $condition[] = ShopCategoriesLayer::getFieldName('added', false) . ' < :date_start';
//                } else {
//                    $condition[] = '(' . ShopCategoriesLayer::getFieldName('added', false) . ' >= :date_start AND ' . ShopCategoriesLayer::getFieldName('added', false) . ' <= :date_now)';
//                    $params[':date_now'] = $date_now->format('Y-m-d');
//                }
//
//                $params[':date_start'] = $date_start->format('Y-m-d');
//            }

            // поле и направление сортировки
            $order_direct = null;
            $order_field = self::getFieldName(!empty($data['order_field']) ? $data['order_field'] : 'name', false);

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
            $criteriaArray = [
                'condition' => join(' AND ', $condition),
                'params' => $params,
            ];

            $relatedCriteriaArray = [
                'condition' => join(' AND ', $relatedCondition),
                'params' => $relatedParams,
                'order' => 'description.'.$order_field . ($order_direct ? : '')
            ];

            // разрешаем перезаписать любые параметры критерии
            if (isset($data['criteria'])) {
                $criteria = array_merge($criteriaArray,$data['criteria']);
            }
            if (isset($data['relatedCriteria'])) {
                $relatedCriteria = array_merge($relatedCriteriaArray,$data['relatedCriteria']);
            }
            $result = [];
            //$criteria=array_merge($criteria, ['with'=>['description'=>$relatedCriteria]]);
            $criteria = new CDbCriteria(array_merge($criteriaArray, ['with'=>['description'=>$relatedCriteriaArray]]));
            self::$dataProvider = new CActiveDataProvider('Projects', [
                 'criteria'=>$criteria,
                ]
            );
        }
        return $dataProvider;
    //        print_r(new CDbCriteria($data));exit;
//            $list = ShopCategoriesLegacy::model()->findAll($criteria);
//            foreach ($list as $val) {
//                $result[] = array_merge(self::fieldMapConvert($val->description->getAttributes()), self::fieldMapConvert($val->getAttributes()));
//            }


    }

    // в функцию нужно прислать массив и указать имя поля, по которому будет определяться
    // поле сортировки. В ответ получим массив, где вложенные записи будут в поле $children_name
    public static function buildTree($data = null,$root=0, $deep=0) {
        $result = [];
        if (count($data) > 0) {

            $id_name = 'id';
            $field_name = 'parent_id';
            $children_name = 'children';
            $max_deep=2;

            if ($deep<=$max_deep){
                foreach ($data as $d) {
                    if (isset($d[$field_name]) && isset($d[$id_name]) && $d[$field_name] == $root) {
                        $deep++;
                        $d[$children_name] = self::buildTree($data,$d[$id_name],$deep);

                        if (count($d[$children_name]) == 0) {
                            unset($d[$children_name]);
                        }
                        // при желании, можно в конфиге принимать обьект, значения которого будут добавляться в каждый элемент
                        $result[] = $d;
                    }
                }
            } else {
                return;
            }
        }
        return $result;
    }

    // на вход нужно подать результат функции buildTree.
    // внутри каждого пункта обязательно должно присутствовать поле name
    // вернет массив, где дерево будет выстроено графически, а не вложенностью
    public static function flatTree($params = null) {
        $config = (object)array_merge(
            [
                'data' => [],
                'show_root' => true,
                'level_prx' => '|_',
                'level_sfx' => '',
                'children_name' => 'children',
                'level' => 0,
                'root_name' => 'Корень'
            ],
            $params
        );

        $children_name = $config->children_name;
        $result = [];

        if ($config->show_root == true) {
            $config->level++;
        }
        foreach ($config->data as $item) {
            $item = (object)$item;
            if ($config->level != 0) {
                $text = '';
                for ($i = 0; $i < $config->level; $i++) {
                    $text .= $config->level_prx;
                }
                $item->name = $text . $config->level_sfx . $item->name;
            }
            $result[] = $item;
            if (isset($item->$children_name) && $item->$children_name != null) {
                $tmp = self::flatTree(
                    array_merge(
                        (array)$config,
                        [
                            'data' => $item->$children_name,
                            'show_root' => false,
                            'level' => $config->level + 1
                        ]
                    )
                );

                foreach ($tmp as $t) {
                    $result[] = $t;
                }
                // чтобы массив не был гиганским
                unset($item->$children_name);
            }
        }

        if ($config->show_root == true) {
            $top =
                [
                    'name' => $config->root_name,
                    'id' => 0
                ];

            array_unshift($result, $top);
        }

        return $result;
    }


//    public static function getList($data = null) {
//        $result = [];
//
//        if ($data) {
//            $list = ShopCategoriesLegacy::model()->findall(new CDbCriteria($data));
//            foreach ($list as $val) {
//               /**/ $result[] = self::fieldMapConvert($val->attributes);
//                $result[]=array_merge(self::fieldMapConvert($val->getAttributes()), ($val->description ? self::fieldMapConvert($val->description->getAttributes()) : []));
//            }
//        } else {
//            $list = ShopCategoriesLegacy::model()->findall();
//            foreach ($list as $val) {
////                $result[] = self::fieldMapConvert($val->attributes);
//                    $result[]=array_merge(self::fieldMapConvert($val->getAttributes()), ($val->description ? self::fieldMapConvert($val->description->getAttributes()) : []));
//            }
//        }
//
//        return $result;
//    }

    /**
     * Обновление значения параметра пользователя
     * @param array $data массив данных для изменяемому полю бд. ключи: id - первичный ключ,field - название изменяемого поля,
     * newValue - новое значение поля
     * @return bool
     */
    public static function updateField($data) {
        // реальное имя поля
        $field = self::getFieldName($data['field'], false);
        $id = (!empty($data['id']) ? $data['id'] : false);
        $value = (!empty($data['newValue']) ? $data['newValue'] : false);

        // все все данные верны, сохраняем
        if ($id && $field && $value) {
            $category = self::getCategory($id);
            $category->setAttributes([$field=>$value],false);
            return $category->withRelated->save(true, ['description']);
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

        // модель категории
        $category = self::getCategory($id, 'add');
        //$category->description = new ShopCategoriesDescriptionLegacy();

        if (!$category) {
            return false;
        }
        if (! $id) { // добавление пользователя

            // если есть пустой id в параметрах - удаяем
            if (array_key_exists('id', $data)) {
                unset($data['id']);
            }
            $data['added'] = new CDbExpression('NOW()');
        }
        $data['modified'] = new CDbExpression('NOW()');

        //переконвертированнные конечные данные, готовые для записи в AR
        $data = self::fieldMapConvert($data, true);
        //записываем данные во все связанные АР
        $category->setAttributes($data, false);

        //todo перепроверять на одинаковые id

        if (!$category->withRelated->save(true,['description'])) {
            self::$errors = $category->getErrors();
            return false;
        }
//        print_r($category->getAttributes());exit;
        //return array_merge(self::fieldMapConvert($category->attributes), self::fieldMapConvert($category->description->attributes));
        return array_merge(self::fieldMapConvert($category->getAttributes()), ($category->description ? self::fieldMapConvert($category->description->getAttributes()) : []));
    }


    public static function delete($id) {
        $parent = self::getCategory($id);
        //print_r($parent);exit;
        if (!($parent && $parent->delete())) {
            return false;
        } else {
            $children = self::findByParentId($id);

            foreach ($children as $val) {
                $child = self::getCategory($val['id']);
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
        if ($id){
            $category = ShopCategoriesLegacy::model()->findByPk($id);
            //print_r($category->description);exit;
            $relations=$category->relations();
            if (!empty($relations)){
                foreach($relations as $r_name => $r_value){
                    if (empty ($category->{$r_name})){
                        $category->{$r_name} = new ShopCategoriesDescriptionLegacy();
                    }
                }
            }

        } else {
            $category = new ShopCategoriesLegacy($scenario);
            $relations=$category->relations();
            if (!empty($relations)){

                foreach($relations as $r_name => $r_value){
                    $r_class = $r_value[1];
                    $category->{$r_name} = new $r_class();
                }
            }
        }
        return $category;
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
    public static function getErrors($attributes = null) {
        return self::$errors;
    }

    /**
     * данные для валидации для внешнего использования
     */
    public static function rules() {
        $rules = array_merge(ShopCategoriesDescriptionLegacy::model()->rules(), ShopCategoriesLegacy::model()->rules());
//        print_r($rules);exit;
        foreach ($rules as &$r) {
            $r[0] = join(',', array_map(function ($el) {
                return self::getFieldName(trim($el));
            }, explode(',', $r[0])));
        }
        return $rules;
    }
}