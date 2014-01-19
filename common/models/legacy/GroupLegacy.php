<?php

/**
 *
 * @package YiiBoilerplate\Models
 */
class GroupLegacy extends CActiveRecord
{
    /** @var string Field to hold a new password when user updates it. */
    public $newPassword;

    /** @var string Password confirmation. Is used only in validation on login. */
    public $passwordConfirm;

    public $primaryKey='admin_groups_id';
//    public $validation_key;

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName()
    {
        return 'admin_groups';
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
