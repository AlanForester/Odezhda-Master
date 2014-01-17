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
//            $list=UsersLayer::usersList();
//            foreach ($list as $val)
//                //$val->attributes['primaryKey'] = 'admin_id';
//                $this->allUsers[]=$val->attributes;
        }
        return $this->allUsers;
    }
    public function changeUserField($params=[]){
        if (!empty($params))
            return UsersLayer::changeField($params);
        else
            throw new CHttpException(400, Yii::t('err', 'No parameters for updating!'));
    }
}
