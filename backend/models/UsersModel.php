<?php

/**
 * Class UsersModel - работа с пользователями
 *
 */
class UsersModel extends CFormModel
{

    public $id;
    public $groups_id;
    public $firstname;
    public $lastname;
    public $email_address;
    public $created;
    public $modified;
    public $logdate;
    public $lognum;

    /**
     * @var array массив всех пользователей.
     * Значение каждого элемента массива - массив с атрибутами пользователя(поля из БД)
     */
    private  $allUsers=[];

    /**
     * @return array задает возвращает массив всех пользователей
     */
    public function getAllUsers(){
        if (!$this->allUsers){
            $this->allUsers=UsersLayer::usersList();
        }
        return $this->allUsers;
    }

    /**
     * @param array $params смотри описание changeField()
     * @return bool успешно ли произошла запись
     */
    public function changeUserField($params=[]){
        return UsersLayer::changeField($params);
    }

    public static function getUser($id) {
        return UsersLayer::getUserById($id);
    }
}
