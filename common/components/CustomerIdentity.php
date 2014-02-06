<?php

/**
 * Authentication information about the admin user registered in our database.
 *
 * This is the override of basic CUserIdentity which authenticates users using User model,
 * i. e. it assumes that you will have administrator users and normal users in the same database table.
 */
class CustomerIdentity extends CUserIdentity
{
    /** @var integer ID of logged user */
    private $id;

    /**
     * Getter method for `id` property.
     * @return integer Internal database ID of the user, null if not set
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Given that the `username` and `password` properties of this object is set,
     * tries to authenticate the user using the User model.
     *
     * On successful authentication fills in its `id` and `username` properties from the User model.
     * @return boolean Whether we have such a user in database and password is correct or not.
     */
    public function authenticate()
    {
        $user = CustomersHelper::authenticate($this->username, $this->password);

        if (is_object($user)) {
            $this->makeAuthenticated($user);
        } else {
            //$user = $this->findUser();
            if ($user == 0)
                return $this->failureBecauseUserNotFound();

            if ($user == 1)
//        if (!$user->verifyPassword($this->password))
                return $this->failureBecausePasswordInvalid();
        }


        return $this->isAuthenticated;
    }


    /** @return User */
    private function findUser()
    {
        return UsersHelper::find($this->username);
//        return User::model()->find(
//            [
//                    'condition' => 'username=:username',
//                'params' => [':username' => $this->username]
//            ]
//        );
    }

    private function failureBecauseUserNotFound()
    {
        $this->errorCode = self::ERROR_USERNAME_INVALID;
        return false;
    }

    private function failureBecausePasswordInvalid()
    {
        $this->errorCode = self::ERROR_PASSWORD_INVALID;
        return false;
    }

    /** @param User $user */
    private function makeAuthenticated($user)
    {
//        $user->regenerateValidationKey();
//        $this->id = User::getUserId($user);
//        $this->username = User::getUserName($user);
//        $this->setState('vkey', $user->validation_key);

        $data = UsersHelper::makeAuthenticated($user);
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->setState('vkey', $data['validation_key']);
        $this->errorCode = self::ERROR_NONE;
    }
}