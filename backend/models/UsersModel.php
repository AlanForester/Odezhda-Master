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
                        break;
                }

                if ($range == 'post_year') {
                    $condition[]= UsersLayer::getFieldName('created', false).' < :date_start';
                } else {
                    $condition[]= '('.UsersLayer::getFieldName('created', false).' >= :date_start AND '.UsersLayer::getFieldName('created', false).' <= :date_now)';
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

            $this->allUsers = UsersLayer::usersList(
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
     * @param array $params смотри описание changeField()
     * @return bool успешно ли произошла запись
     */
    public function changeUserField($params = []) {
        return UsersLayer::changeField($params);
    }

    public function changeUser($params = []) {
        return UsersLayer::changeUser($params);
    }

    public function getUser($id) {
        //print_r(UsersLayer::getUserById($id));print_r($this->attributes);exit;
        //        $this->attributes=UsersLayer::getUserById($id);
        //        print_r($this->attributes);exit;
        return UsersLayer::getUserById($id);
    }
}
