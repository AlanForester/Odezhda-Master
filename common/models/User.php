<?php

class User
{

    public static function findByAttributes($attributes)
    {
        return LegacyUser::model()->findByAttributes($attributes);
    }

    public static function find($username)
    {
        return LegacyUser::model()->find(
            [
                'condition' => 'admin_email_address=:username',
                'params' => [':username' => $username]
            ]
        );
    }

    /**
     * Проверка логина и пароля
     * @param string $username логин
     * @param string $password пароль
     * @return int 0 - пользователь не найден, 1 - не правильный пароль, AR- найденный пользователь
     */
    public static function authenticate($username, $password)
    {
        $user = self::find($username);
        if (!$user)
            return 0;
        //$this->failureBecauseUserNotFound();

        if (!$user->verifyPassword($password))
            return 1;
        //$this->failureBecausePasswordInvalid();

        return $user;
        //$this->makeAuthenticated($user);

        //return $this->isAuthenticated;
    }

    public static function makeAuthenticated($user)
    {
        $user->regenerateValidationKey();
//        $this->id = User::getUserId($user);
//        $this->username = User::getUserName($user);
//        $this->setState('vkey', $user->validation_key);
//        $this->errorCode = self::ERROR_NONE;

        return [
            'id' => $user->admin_id,
            'username' => $user->admin_email_address,
            'validation_key' => $user->validation_key
        ];
    }

    public static function getUserName($model)
    {
        return $model->admin_email_address;
    }

    public static function getUserId($model)
    {
        return $model->admin_id;
    }
}