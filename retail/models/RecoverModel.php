<?php
/**
 * Model class for user register form at retail site
 *
 * @package YiiBoilerplate\Retail
 *
 * @property string $name
 * @property string $email
 * @property string $day
 * @property string $month
 * @property string $year
 * @property string $phone
 * @property string $promo
 * @property bool $notes_email
 * @property bool $notes_sms
 * @property bool $remember
 *
 */

class RecoverModel {
    /**
     * Registration
     * @return bool
     */
    public function recover() {
        if($user = CustomersHelper::save($this->attributes)){
            if ($this->_identity === null) {
                $this->_identity = new CustomerIdentity($user->email, $user->password);
                $this->_identity->registerAuthenticate($user);
            }
            if ($this->_identity->isAuthenticated) {
                $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
                Yii::app()->user->allowAutoLogin=true;
                Yii::app()->user->login($this->_identity, $duration);
                return true;
            }
        }
        $this->addErrors(CustomersHelper::getErrors());

        return false;
    }
}