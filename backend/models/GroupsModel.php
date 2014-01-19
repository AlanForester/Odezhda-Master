<?php

/**
 * Class GroupsModel - работа с группамми пользователей
 *
 */
class GroupsModel extends CFormModel {

    public $id;
    public $name;

    /**
     * @var array массив всех пользователей.
     * Значение каждого элемента массива - массив с атрибутами пользователя(поля из БД)
     */
    private $list = [];

    /**
     * @return array задает возвращает массив всех пользователей
     */
    public function getList() {
        if (!$this->list) {
            $this->list = GroupsLayer::getList();
        }
        return $this->list;
    }

    /**
     * @param array $params смотри описание changeField()
     * @return bool успешно ли произошла запись
     */
//    public function changeUserField($params = []) {
//        return UsersLayer::changeField($params);
//    }

//    public function getUser($id) {
//        //print_r(UsersLayer::getUserById($id));print_r($this->attributes);exit;
//        //        $this->attributes=UsersLayer::getUserById($id);
//        //        print_r($this->attributes);exit;
//        return UsersLayer::getUserById($id);
//    }
}
