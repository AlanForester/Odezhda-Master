<?php

class UsersLayer
{
    public static function usersList()
    {
        return UserLegacy::model()->findall();
    }
}