<?php

/**
 * Class UsersModel - работа с пользователями
 *
 */
class UsersModel
{
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
}
