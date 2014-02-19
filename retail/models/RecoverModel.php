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

    public $customer;
    private $tableName='retail_recovery';

    /**
     * Генрируем хеш восстановления и делаем запись в таблицу восстановления
     * @return bool
     */
    public function recover() {
        $hash=md5($this->customer->email.time());
        $result = Yii::app()->db->createCommand()
            ->insert($this->tableName, [
                'customer_id'=>$this->customer->id,
                'hash'=>$hash,
            ]);
        return $result ? $hash : false;
    }

    /**
     * Проверяем существует ли пользователь
     * да - возвращаем id пользователя
     * нет - аозвращаем false
     * @param $email
     * @return bool
     */
    public function isCustomerExist($email){
        $customer_model = new CustomerModel();
        $this->customer = $customer_model->getCustomerByEmail($email);
        return !empty($this->customer)? true : false;
    }

    public function restoreCustomer($hash){
        $recoveryInfo = Yii::app()->db->createCommand()
            ->select('*')
            ->from($this->tableName)
            ->where('hash=:hash', array(':hash'=>$hash))
            ->queryRow();
        if (!empty($recoveryInfo)){
            $customer_model = new CustomerModel();
            $customer = $customer_model->getCustomer($recoveryInfo['customer_id']);
            $identity = new CustomerIdentity($customer->email, $customer->password);
            $identity->registerAuthenticate($customer);
            if ($identity->isAuthenticated) {
                Yii::app()->user->login($identity);
                Yii::app()->db->createCommand()
                    ->delete($this->tableName, 'hash=:hash', array(':hash'=>$hash));
            return true;
            }
        }
        return false;
    }
}