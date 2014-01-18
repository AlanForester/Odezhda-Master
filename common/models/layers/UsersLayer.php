<?php

class UsersLayer
{
    /**
     * @var array (поле БД => требуемое поле для модели)
     */
    private static $field_map = [
        'admin_id' => 'id',
        'admin_groups_id' => 'groups_id',
        'admin_firstname' => 'firstname',
        'admin_lastname' => 'lastname',
        'admin_email_address' => 'email_address',
        'admin_password' => 'password',
        'admin_created' => 'created',
        'admin_modified' => 'modified',
        'admin_logdate' => 'logdate',
        'admin_lognum' => 'lognum',
        'admin_cat_access' => 'cat_access',
        'admin_right_access' => 'right_access',
    ];

    /**
     * @param $row массив соответствий
     * @param bool $reverse конвертировать в прямую или обратную сторону(по умолчанию -  прямую)
     * @return mixed конвертированный по ключам массив
     */
    private static function fieldMapConvert($row,$reverse=false){
        if (!$reverse){
            foreach (self::$field_map as $k=>$v){
                $row[$v] = $row[$k];
                unset($row[$k]);
            }
        }
        else {
            foreach (self::$field_map as $k=>$v){
                $row[$k] = $row[$v];
                unset($row[$v]);
            }
        }

        return $row;
    }

    public static function usersList()
    {
        $result = [];
        $list=UserLegacy::model()->findall();
        foreach ($list as $val){
            $result[]=self::fieldMapConvert($val->attributes);
        }

        return $result;
    }

    /**
     * @param $params массив данных по изменяемому полю бд. ключи: id - первичный ключ,field - название изменяемого поля,
     * newValue - новое значение поля
     * @return bool
     */
    public static function changeField($params)
    {
        $convertField=array_search($params['field'],self::$field_map);
        if (!empty($params['id']) && $convertField && !empty($params['newValue'])){
            $find=UserLegacy::model()->findByPk($params['id']);
            //$find=UserLegacy::model()->find("admin_id = :admin_id", array("admin_id" => $params['id'] ));
            $find->{$convertField}=$params['newValue'];
            //todo изменить AR под свою таблицу (иначе необходимо запрещать валидацию в save)
            if($find->save(true,[$convertField])) //$find->save(false) : false запрещает валидацию
                return true;
            else
                return false;
//          UserLegacy::model()->updateAll([$convertField => $params['newValue']],"admin_id = :admin_id", array("admin_id" => $params['id'] ));
//          return true;
        }
        else
            return false;
    }

    public static function getUserById($userId) {
        if (!empty($userId)){
            $result=UserLegacy::model()->findByPk($userId);
            if ($result){
                $result=self::fieldMapConvert($result->attributes);
                return $result;
            }
            else
                return false;
            }
        else
            return false;
    }
}