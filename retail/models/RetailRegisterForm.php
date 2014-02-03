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

class RetailRegisterForm extends CFormModel {

    /**
     * Validation rules
     *
     * @see CModel
     * @return array
     */
    public function rules()
    {
        return [
            ['name, email', 'required'],
            ['email', 'email'],
            ['name, month, phone, promo', 'type', 'type'=>'string'],
            ['name', 'length', 'max'=>255],
            ['day', 'numerical', 'min'=>1, 'max'=>2],
            ['month', 'length', 'min'=>3, 'max'=>9],
            ['year', 'numerical', 'max'=>4],
            ['notes_email, notes_sms, remember', 'boolean'],
        ];
    }

    /**
     * Returns attributes labels
     *
     * @see CModel
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя, Фамилия',
            'email' => 'E-mail',
            'day' => 'день',
            'month' => 'месяц',
            'year' => 'год',
            'phone' => 'Мобильный',
            'promo' => 'Промо-код',
            'notes_email' => 'Я хочу получать уведомления по электронной почте',
            'notes_sms' => 'Я хочу получать sms-уведомления',
            'remember' => 'Запомнить меня',
        ];
    }
}