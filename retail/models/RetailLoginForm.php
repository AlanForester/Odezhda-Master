<?php

/**
 * Model class for login form at retail site
 *
 * @package YiiBoilerplate\Retail
 */
class RetailLoginForm extends CFormModel {

    /**
     * User name
     * @var string
     */
    public $username;

    /**
     * User password
     * @var string
     */
    public $password;

    /**
     * Whether to login user for some amount of time or until end of session.
     * @var bool
     */
    public $rememberMe;

    /** @var CUserIdentity */
    private $_identity;


    /**
     * Validation rules
     * @see CModel::rules()
     * @return array
     */
    public function rules() {
        return [
            ['password, username', 'required'],
            ['password', 'authenticate'],
        ];
    }

    /**
     * Returns attribute labels
     * @see CModel::attributeLabels()
     * @return array
     */
    public function attributeLabels() {
        return [
            'username' => 'E-mail',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }

    /**
     * Inline validator for password field.
     *
     */
    public function authenticate() {
        if ($this->hasErrors())
            return;

        $this->_identity = new CustomerIdentity($this->username, $this->password);
        if ($this->_identity->authenticate())
            return;

        $this->addError('username', 'Неправильный e-mail или пароль');
        $this->addError('password', 'Неправильный e-mail или пароль');
    }

    /**
     * Login
     *
     * @return bool
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new CustomerIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->isAuthenticated) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->allowAutoLogin=true;

            Yii::app()->user->login($this->_identity, $duration);
            return true;
        }

        return false;
    }

    /**
     * Caching getter for user model associated with given username.
     *
     * @return User
     */
    public function getUser() {
        if ($this->_user === null)
            $this->_user = CustomersHelper::findByAttributes(['[[email]]' => $this->username]);

        return $this->_user;
    }
}