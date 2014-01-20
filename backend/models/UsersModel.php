<?php

/**
 * Class UsersModel - работа с пользователями
 *
 */
class UsersModel extends CFormModel {

    public $id;
    public $group_id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $created;
    public $modified;
    public $logdate;
    public $lognum;
    public $cat_access;
    public $right_access;

    /**
     * @var array массив всех пользователей.
     * Значение каждого элемента массива - массив с атрибутами пользователя(поля из БД)
     */
    private $allUsers = [];

    /**
     * @param array $data массив данных из которых будет создан массив для CDbCriteria
     * @return array задает возвращает массив всех пользователей
     */
    public function getList($data) {
        if (!$this->allUsers) {

            // todo: переместить все в прослойку
            $condition = [];
            $params = [];

            // фильтр по тексту
            if (!empty($data['text_search'])) {
                $condition[] = '(' . join(
                        ' OR ',
                        [
                            UsersLayer::getFieldName('firstname', false) . ' LIKE :text',
                            UsersLayer::getFieldName('lastname', false) . ' LIKE :text',
                            UsersLayer::getFieldName('email', false) . ' LIKE :text',
                            UsersLayer::getFieldName('id', false) . ' LIKE :text'
                        ]
                    ) . ')';

                $params[':text'] = '%' . $data['text_search'] . '%';
            }

            // фильтр по группе
            if (!empty($data['filter_groups'])) {
                $condition[] = UsersLayer::getFieldName('group_id', false) . '=:group';
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
                    $condition[] = UsersLayer::getFieldName('created', false) . ' < :date_start';
                } else {
                    $condition[] = '(' . UsersLayer::getFieldName('created', false) . ' >= :date_start AND ' . UsersLayer::getFieldName('created', false) . ' <= :date_now)';
                    $params[':date_now'] = $date_now->format('Y-m-d');
                }

                $params[':date_start'] = $date_start->format('Y-m-d');
            }

            // поле и направление сортировки
            $order_direct = null;
            $order_field = UsersLayer::getFieldName(!empty($data['order_field']) ? $data['order_field'] : 'firstname', false);

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

            $this->allUsers = UsersLayer::getList(
                [
                    'condition' => join(' AND ', $condition),
                    'params' => $params,
                    'order' => $order_field . ($order_direct ? : '')
                ]
            );
        }
        return $this->allUsers;
    }

    /**
     * Сохарение или создание нового пользователь
     * @param array $data исходные данные
     * @return bool|array массив данных пользователя или false
     */
    public function save($data) {
        return UsersLayer::save($data);
    }

    /**
     * Обновление параметра пользователя
     * @param array $params смотри описание updateField()
     * @return bool успешно ли произошла запись
     */
    public function updateField($params = []) {
        return UsersLayer::updateField($params);
    }

    /**
     * АР модель пользователя на основе id
     * @param int $id id пользователя
     * @return UserLegacy
     */
    public function getUser($id) {
        return UsersLayer::getUser($id);
    }

    /**
     * Данные пользователя в виде массива
     * @param int $id id пользователя
     * @return bool|array массив или false
     */
    public function getUserData($id) {
        $user = self::getUser($id);
        return ($user ? UsersLayer::fieldMapConvert($user->attributes) : false);
    }
}
