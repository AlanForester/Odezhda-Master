<?php

/**
 * Class UsersModel - работа с пользователями
 *
 */
class ShopCategoriesModel extends CFormModel {

    public $id;
    public $image;
    public $added;
    public $status;
    public $parent_id;
    public $sort_order;
    public $modified;
    public $default_manufacturers;
    public $markup;
    public $xml_flag;

    public $language_id;
    public $name;
    public $heading_title;
    public $description;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;


    /**
     * @var array массив всех категорий.
     * Значение каждого элемента массива - массив с атрибутами категории(поля из БД)
     */
    private $allCategories = [];

    /**
     * @param array $data массив данных из которых будет создан массив для CDbCriteria
     * @return array задает возвращает массив всех пользователей
     */

//    public function rules()
//    {
//        return array(
//            array('password, email', 'required', 'on'=>'add', 'message'=>'Некорректный E-mail'),
//        );
//    }

    public function attributeLabels() {
        return array(
            'email' => Yii::t('labels', 'E-mail'),
            'password' => Yii::t('labels', 'Пароль'),
        );
    }

    public function rules()
    {
        return ShopCategoriesLayer::rules();
//        return [
//            array('email', 'email','message' => Yii::t('validation', "Некорректный E-mail!")),
//            array('email', 'unique', 'message' => Yii::t('validation', "E-mail должен быть уникальным!")),
//            array('email', 'required', 'on'=>'add', 'message'=>Yii::t('validation', 'Поле E-mail являются обязательными!')),
//            array('password', 'required', 'on'=>'add', 'message'=>Yii::t('validation', 'Поле пароль являются обязательными!')),
//        ];
    }

    public function validate($attributes=null, $clearErrors=true) {
        return ShopCategoriesLayer::validate($attributes,$clearErrors);
    }

    public function getErrors($attributes=null){
        return ShopCategoriesLayer::getErrors($attributes);
    }


//    public function getList($data=null) {
//        if (!$this->allCategories) {
//
//            // todo: переместить все в прослойку
//            $condition = [];
//            $params = [];
//
//            // фильтр по тексту
//            if (!empty($data['text_search'])) {
//                $condition[] = '(' . join(
//                        ' OR ',
//                        [
//                            ShopCategoriesLayer::getFieldName('firstname', false) . ' LIKE :text',
//                            ShopCategoriesLayer::getFieldName('lastname', false) . ' LIKE :text',
//                            ShopCategoriesLayer::getFieldName('email', false) . ' LIKE :text',
//                            ShopCategoriesLayer::getFieldName('id', false) . ' LIKE :text'
//                        ]
//                    ) . ')';
//
//                $params[':text'] = '%' . $data['text_search'] . '%';
//            }
//
//            // фильтр по группе
//            if (!empty($data['filter_groups'])) {
//                $condition[] = ShopCategoriesLayer::getFieldName('group_id', false) . '=:group';
//                $params[':group'] = $data['filter_groups'];
//            }
//
//            // фильтр по дате создания
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
//                    $condition[] = ShopCategoriesLayer::getFieldName('created', false) . ' < :date_start';
//                } else {
//                    $condition[] = '(' . ShopCategoriesLayer::getFieldName('created', false) . ' >= :date_start AND ' . UsersLayer::getFieldName('created', false) . ' <= :date_now)';
//                    $params[':date_now'] = $date_now->format('Y-m-d');
//                }
//
//                $params[':date_start'] = $date_start->format('Y-m-d');
//            }
//
//            // поле и направление сортировки
//            $order_direct = null;
//            $order_field = ShopCategoriesLayer::getFieldName(!empty($data['order_field']) ? $data['order_field'] : 'firstname', false);
//
//            if (isset($data['order_direct'])) {
//                switch ($data['order_direct']) {
//                    case 'up':
//                        $order_direct = ' ASC';
//                        break;
//                    case 'down':
//                        $order_direct = ' DESC';
//                        break;
//                }
//            }
//
////            $this->allCategories = ShopCategoriesLayer::getList(
////                [
////                    'condition' => join(' AND ', $condition),
////                    'params' => $params,
////                    'order' => $order_field . ($order_direct ? : '')
////                ]
////            );
//            $this->allCategories = ShopCategoriesLayer::getList();
//        }
//        return $this->allCategories;
//    }

    public function findByParentId ($id){
        return ShopCategoriesLayer::findByParentId($id);
    }

    /**
     * Сохарение или создание нового пользователь
     * @param array $data исходные данные
     * @return bool|array массив данных пользователя или false
     */
    public function save($data) {
//        $this->addError('password','Incorrect username or password.');
        return ShopCategoriesLayer::save($data);
    }

    /**
     * Обновление параметра пользователя
     * @param array $params смотри описание updateField()
     * @return bool успешно ли произошла запись
     */
    public function updateField($params = []) {
        return ShopCategoriesLayer::updateField($params);
    }

    /**
     * АР модель пользователя на основе id
     * @param int $id id пользователя
     * @return UserLegacy
     */
    public function getUser($id, $scenario) {
        return ShopCategoriesLayer::getUser($id, $scenario);
    }

    /**
     * Данные пользователя в виде массива
     * @param int $id id пользователя
     * @return bool|array массив или false
     */
    public function getUserData($id, $scenario) {
        $user = self::ShopCategoriesLayer($id, $scenario);
        return ($user ? ShopCategoriesLayer::fieldMapConvert($user->attributes) : false);
    }

    public function delete($id) {
        return ShopCategoriesLayer::delete($id);
    }
}