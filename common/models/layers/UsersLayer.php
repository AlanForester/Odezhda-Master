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

    private static function fieldMapConvert($row){
        foreach (self::$field_map as $k=>$v){
            $row[$v] = $row[$k];
            unset($row[$k]);
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
}