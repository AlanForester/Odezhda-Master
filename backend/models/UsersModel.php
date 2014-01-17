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
            $list=UsersLayer::usersList();
//            echo '<pre>';
//            print_r($list);
            foreach ($list as $val)
                //$val->attributes['primaryKey'] = 'admin_id';
                $this->allUsers[]=$val->attributes;
        }
        return $this->allUsers;
    }
}
