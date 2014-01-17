<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $username
 * @property string $login_ip
 * @property integer $login_attempts
 * @property integer $login_time
 * @property string $validation_key
 * @property string $password_strategy
 * @property boolean $requires_new_password
 * @property integer $create_id
 * @property integer $create_time
 * @property integer $update_id
 * @property integer $update_time
 * @property integer $delete_id
 * @property integer $delete_time
 * @property integer $status
 *
 * @!method bool verifyPassword
 *
 * @package YiiBoilerplate\Models
 */
class UserLegacy extends CActiveRecord
{
    /** @var string Field to hold a new password when user updates it. */
    public $newPassword;

    /** @var string Password confirmation. Is used only in validation on login. */
    public $passwordConfirm;

//    public $primaryKey='admin_id';
//    public $validation_key;

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName()
    {
        return 'admin';
    }

    /**
     * Behaviors associated with this ActiveRecord.
     *
     * We are using the APasswordBehavior because it allows neat things
     * like changing the password hashing methods without rebuilding the whole user database.
     *
     * @see https://github.com/phpnode/YiiPassword
     *
     * @return array Configuration for the behavior classes.
     */
//	public function behaviors()
//	{
//		Yii::import('common.extensions.behaviors.password.*');
//		return array(
//			// Password behavior strategy
//			"APasswordBehavior" => array(
//				"class" => "APasswordBehavior",
//				"defaultStrategyName" => "legacy",
//                "passwordAttribute"=>"admin_password",
//				"strategies" => array(
//					"legacy" => array(
//						"class" => "ALegacyPasswordStrategy"
////						"workFactor" => 14,
////						"minLength" => 8
//					)
//				),
//			)
//		);
//	}

    public function verifyPassword($originPassword)
    {
        //echo($this->admin_password);exit;
        if ($this->val_not_null($originPassword) && $this->val_not_null($this->admin_password)) {
            // split apart the hash / salt
            $stack = explode(':', $this->admin_password);

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
            if ( (is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
                return true;
            } else {
                return false;
            }
        }
    }
    /**
     * Validation rules for model attributes.
     *
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email', 'email'),
            array('username, email', 'unique'),
            array('passwordConfirm', 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('validation', "Passwords don't match")),
            array('newPassword, password_strategy ', 'length', 'max' => 50, 'min' => 8),
            array('email, password, salt', 'length', 'max' => 255),
            array('requires_new_password, login_attempts', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, email', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Customized attribute labels (attr=>label)
     *
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => Yii::t('labels', 'Username'),
            'password' => Yii::t('labels', 'Password'),
            'newPassword' => Yii::t('labels', 'Password'),
            'passwordConfirm' => Yii::t('labels', 'Confirm password'),
            'email' => Yii::t('labels', 'Email'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $PARTIAL = true;

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, $PARTIAL);
        $criteria->compare('email', $this->email, $PARTIAL);

        return new CActiveDataProvider(get_class($this), compact('criteria'));
    }

    /**
     * Generates a new validation key (additional security for cookie)
     */
    public function regenerateValidationKey()
    {
        $validation_key = md5(mt_rand() . mt_rand() . mt_rand());
        //$this->saveAttributes(compact('validation_key'));
    }

    /**
     * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     *
     * @param string $className
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
