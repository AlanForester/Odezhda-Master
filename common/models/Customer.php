<?php

/**
 * Модель управления таблицей пользователей сайта retail.
 */
class Customer extends LegacyActiveRecord {
    /** @var string Field to hold a new password when user updates it. */
//    public $newPassword;

    /** @var string Password confirmation. Is used only in validation on login. */
//    public $passwordConfirm;

//    public $primaryKey = 'id';
    //    public $validation_key;

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        return 'customers';
    }

    public function fieldMap() {
        return [
            'customers_id' => 'id',
            'customers_dob' => 'dob',//day of birth
            'customers_firstname' => 'firstname',
            'customers_lastname' => 'lastname',
            'customers_email_address' => 'email',
            'customers_password' => 'password',
            'customers_telephone' => 'phone',
            'customers_groups_id' => 'group_id',
        ];
    }

    //----------Функции из старой системы
    public function verifyPassword($originPassword) {
        if ($this->val_not_null($originPassword) && $this->val_not_null($this->password)) {
            // split apart the hash / salt
            $stack = explode(':', $this->password);

            if (sizeof($stack) != 2) return false;

            if (md5($stack[1] . $originPassword) == $stack[0]) {
                return true;
            }
        }

        return false;

    }

    public function val_not_null($value) {
        if (is_array($value)) {
            if (sizeof($value) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            if ((is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
                return true;
            } else {
                return false;
            }
        }
    }

    // Return a random value
    public function tep_rand($min = null, $max = null) {
        static $seeded;

        if (!$seeded) {
            mt_srand((double)microtime() * 1000000);
            $seeded = true;
        }

        if (isset($min) && isset($max)) {
            if ($min >= $max) {
                return $min;
            } else {
                return mt_rand($min, $max);
            }
        } else {
            return mt_rand();
        }
    }

    public function encrypt_password($plain) {
        $password = '';

        for ($i = 0; $i < 10; $i++) {
            $password .= $this->tep_rand();
        }

        $salt = substr(md5($password), 0, 2);

        $password = md5($salt . $plain) . ':' . $salt;

        return $password;
    }
    //--------------------------------------
    /**
     * Правила проверки полей модели
     *
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
    public function getRules() {
        return [
            ['email', 'email', 'message' => Yii::t('validation', "Некорректный E-mail")],
//            ['email', 'unique', 'message' => Yii::t('validation', "E-mail должен быть уникальным")],
            ['email', 'required', 'message' => Yii::t('validation', 'E-mail является обязательным')],
            ['firstname', 'required', 'message' => Yii::t('validation', 'Имя является обязательным')],
            ['lastname', 'default'],
//            ['group_id', 'required', 'message' => Yii::t('validation', 'Группа является обязательной')],
            ['password', 'required','message' => Yii::t('validation', 'Пароль является обязательным')]
        ];
    }

    /**
     * Заголовки полей (поле=>заголовок)
     *
     * @return array
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('labels', 'ID'),
            'group_id' => Yii::t('labels', 'Группа'),
            'firstname' => Yii::t('labels', 'Имя'),
            'lastname' => Yii::t('labels', 'Фамилия'),
            'email' => Yii::t('labels', 'E-mail'),
            'password' => Yii::t('labels','Пароль'),

            'lognum' => Yii::t('labels', 'Кол-во авторизаций'),
            'logdate' => Yii::t('labels', 'Последний визит'),
            'modified' => Yii::t('labels', 'Изменен'),
            'created' => Yii::t('labels', 'Создан'),
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
//    public function search() {
//        $PARTIAL = true;
//
//        $criteria = new CDbCriteria;
//        $criteria->compare('id', $this->id);
//        $criteria->compare('username', $this->username, $PARTIAL);
//        $criteria->compare('email', $this->email, $PARTIAL);
//
//        return new CActiveDataProvider(get_class($this), compact('criteria'));
//    }

    /**
     * Generates a new validation key (additional security for cookie)
     */
//    public function regenerateValidationKey() {
//        $validation_key = md5(mt_rand() . mt_rand() . mt_rand());
//        //$this->saveAttributes(compact('validation_key'));
//    }

    /**
     * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     *
     * @param string $className
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
