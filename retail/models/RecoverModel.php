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
         return Yii::app()->db->createCommand()
            ->insert($this->tableName, [
                'customer_id'=>$this->customer->id,
                'hash'=>$hash,
            ]);
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
}