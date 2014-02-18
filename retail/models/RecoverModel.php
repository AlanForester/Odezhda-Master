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
    public function recover($formData) {
        Yii::app()->db->createCommand()
            ->insert($this->orderTables[1], [
                'customer_id'=>$order_id,
                'hash'=>$hash,
            ]);
    }
}