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

    public $name_surname;
//    public $surname;
    public $email;
    public $phone;
    public $day;
    public $month;
    public $year;
    public $notes_email;
    public $notes_sms;
    public $promo;

    public $rememberMe;

    /** @var CUserIdentity */
    private $_identity;

    /**
     * Validation rules
     * @see CModel
     * @return array
     */
    public function rules()
    {
        return [
            ['name_surname, email', 'required'],
            ['email', 'email'],
            ['name_surname, month, phone, promo', 'type', 'type'=>'string'],
            ['name_surname', 'length', 'max'=>255],
            ['day', 'numerical', 'min'=>1, 'max'=>2],
            ['month', 'numerical', 'min'=>1, 'max'=>2],
            ['year', 'numerical', 'max'=>4],
            ['notes_email, notes_sms, rememberMe', 'boolean'],
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