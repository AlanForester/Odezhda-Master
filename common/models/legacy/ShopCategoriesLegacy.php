<?php

/**
 * This is the model class for table "{{categories}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $categories_id
 * @property integer $parent_id
 * @property string $categories_image
 * @property integer $sort_order
 * @property integer $date_added
 * @property integer $last_modified
 * @property integer $categories_status
 * @property integer $default_manufacturers
 * @property float $markup
 * @property boolean $xml_flag
 *
 */
class ShopCategoriesLegacy extends CActiveRecord {
    public $categories_id;
    public $parent_id;
    public $categories_image;
    public $sort_order;
    public $date_added;
    public $last_modified=52;
    public $categories_status;
    public $default_manufacturers;
    public $markup;
    public $xml_flag;

    public $language_id;
    public $categories_name=5;
    public $categories_heading_title=4;
    public $categories_description='';
    public $categories_meta_title;
    public $categories_meta_description;
    public $categories_meta_keywords;

    public $primaryKey = 'categories_id';

    protected $_alldata = [];

    /**
     * Name of the database table associated with this ActiveRecord
     * @return string
     */
    public function tableName() {
        return 'categories';
    }

    /**
     * Связь с таблицей categories_description
     * @return array
     */
    public function relations() {
        return [
            'description' => [self::HAS_ONE, 'ShopCategoriesDescriptionLegacy', 'categories_id'],
        ];
    }

    public function attrs ($data){
        if(!is_array($data))
            return;
        //$attributes=array_flip($safeOnly ? $this->getSafeAttributeNames() : $this->attributeNames());
//        print_r($data);exit;
        foreach($data as $name=>$value)
        {
                $this->$name=$value;
        }
    }


    protected function afterDelete() {
        parent::afterDelete();
        //print_r($this->categories_id);exit;
        ShopCategoriesDescriptionLegacy::model()->deleteAll('categories_id=:id', array(':id' => $this->categories_id));
    }

    protected function afterSave() {
        parent::afterSave();

        foreach($this->relations() as $k=>$v){
//            $this->getActiveFinder($k);
            $this->{$k}->save();
        }

//        $id = $this->categories_id;
//        $description = ($this->isNewRecord ? new ShopCategoriesDescriptionLegacy() : ShopCategoriesDescriptionLegacy::model()->find('categories_id=:categories_id', array(':categories_id' => $id)));
        //print_r($description);exit;

//        $this->_alldata['categories_id'] = $id;

//        $description->setAttributes($this->_alldata, false);
//        $description->save();
    }

    /**
     * Вызываем методы setAttributes для каждого из совмещенных таблиц AR
     * @param array $values
     * @param bool $safeOnly
     */
    public function setRelatedAttributes($values, $safeOnly = true) {
        foreach ($this->relations() as $key => $val) {
            //$rel = $this->getRelated($key);
            //$rel->setAttributes($values, $safeOnly);
//            $this->{$key}->setAttributes($values, false);
//            if (!isset($this->{$key})){
//                $this->{$key}= new
//            }
            $this->_re
        }
    }

    public function setAllData($values){
//        parent::setAttributes($values,$safeOnly);
        $this->_alldata = $values;
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
    /**
     * Validation rules for model attributes.
     *
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
//    public function rules()
//    {
//        // NOTE: you should only define rules for those attributes that
//        // will receive user inputs.
//        return array(
//            array('admin_email_address', 'email','message' => Yii::t('validation', "Некорректный E-mail")),
//            array('admin_email_address', 'unique', 'message' => Yii::t('validation', "E-mail должен быть уникальным")),
//            array('admin_email_address', 'required', 'message'=>Yii::t('validation', 'E-mail является обязательным')),
//            array('admin_firstname', 'required', 'message'=>Yii::t('validation', 'Имя является обязательным')),
//            array('admin_groups_id', 'required', 'message'=>Yii::t('validation', 'Группа является обязательной')),
//            array('admin_password', 'required', 'on'=>'add', 'message'=>Yii::t('validation', 'Пароль является обязательным')),
//
//           // array('passwordConfirm', 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('validation', "Passwords don't match")),
//           // array('newPassword, password_strategy ', 'length', 'max' => 50, 'min' => 8),
//           // array('email, password, salt', 'length', 'max' => 255),
//          //  array('requires_new_password, login_attempts', 'numerical', 'integerOnly' => true),
//         //   // The following rule is used by search().
//            // Please remove those attributes that should not be searched.
//         //   array('id, username, email', 'safe', 'on' => 'search'),
//        );
//    }

    /**
     * Customized attribute labels (attr=>label)
     *
     * @return array
     */
//    public function attributeLabels()
//    {
//        return array(
//            'id' => 'ID',
//            'username' => Yii::t('labels', 'Username'),
//            'password' => Yii::t('labels', 'Password'),
//            'newPassword' => Yii::t('labels', 'Password'),
//            'passwordConfirm' => Yii::t('labels', 'Confirm password'),
//            'email' => Yii::t('labels', 'Email'),
//        );
//    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        $PARTIAL = true;

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, $PARTIAL);
        $criteria->compare('email', $this->email, $PARTIAL);

        return new CActiveDataProvider(get_class($this), compact('criteria'));
    }

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
