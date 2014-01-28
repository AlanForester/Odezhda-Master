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
//    public $categories_id;
//    public $parent_id;
//    public $categories_image;
//    public $sort_order;
//    public $date_added;
//    public $last_modified;
//    public $categories_status;
//    public $default_manufacturers;
//    public $markup;
//    public $xml_flag;
//
//    public $language_id;
//    public $categories_name;
//    public $categories_heading_title;
//    public $categories_description;
//    public $categories_meta_title;
//    public $categories_meta_description;
//    public $categories_meta_keywords;

    public $primaryKey = 'categories_id';
    private $__errors=[];	// attribute name => array of errors

    protected $_allData = [];

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
            'rel_description' => [self::HAS_ONE, 'ShopCategoriesDescriptionLegacy', 'categories_id'],
        ];
    }

    public function __get($name){
//        $name = ShopCategoriesLayer::getFieldName($name,false);
//        foreach ($this->relations() as $a=>$r){
//            if (isset($this->$a->$name)){
//                return $this->$a->$name;
//                //$name = $a.'.'.$name;
//                //break;
//            }
//        }
//        return parent::__get($name);
        return parent::__get(ShopCategoriesLayer::getFieldName($name,false));
    }

    public function __set($name,$value){
        return parent::__set(ShopCategoriesLayer::getFieldName($name,true),$value);
    }

    public function __isset($name) {
        return parent::__isset(ShopCategoriesLayer::getFieldName($name,false));
    }

    /**
     * Перекрываем родительский метод. Устанавливаем атрибуты еще и в связанных АР
     * @param array $values массив данных для установки
     * @param bool $safeOnly только безопасные атрибуты
     */
    public function setAttributes($values,$safeOnly=true) {
        parent::setAttributes($values, $safeOnly);
        $relations=$this->relations();
        if (!empty($relations)){
            foreach($relations as $r_name => $r_value){
                $this->{$r_name}->setAttributes($values,$safeOnly);
            }
        }
    }

//    public function setAttribute($name,$value) {
//        if (parent::setAttribute($name,$value)){
//            return true;
//        } else {
//            $relations=$this->relations();
//            if (!empty($relations) && !array_key_exists($name, $relations)){ //вторая проверка нужна(если нет - ошибка при добавлении getCategory в прослойке)
//                foreach($relations as $r_name => $r_value){
//                    if ($this->{$r_name}->setAttribute($name,$value)){
//                        return true;
//                    }
//                }
//            }
//        }
//        return false;
//    }


    public function getErrors($attribute=null) {
//        if($attribute===null)
//            return $this->_errors;
//        else
//            return isset($this->_errors[$attribute]) ? $this->_errors[$attribute] : array();
//
        $this->__errors=parent::getErrors($attribute);
        $relations=$this->relations();
        if (!empty($relations)){
            foreach($relations as $r_name => $r_value){
                $this->__errors=$this->{$r_name}->getErrors($attribute);
            }
        }
        return ($this->__errors);
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
        return [
            ['sort_order, parent_id, markup, default_manufacturers', 'numerical', 'message' => Yii::t('validation', "Поле должно быть числовым")],
            ['xml_flag, categories_status', 'boolean', 'message'=>Yii::t('validation', 'Неверное значение поля')],
            ['sort_order', 'length', 'max' => 3, 'message'=>Yii::t('validation', 'Слишком большое число (максимум 999)')],
            //['categories_name', 'required', 'message' => Yii::t('validation', 'Название является обязательным')],
//            array('language_id', 'numerical', 'integerOnly' => true, 'message'=>Yii::t('validation', 'Поле должно быть числовым')),
//            array('language_id', 'exist', 'allowEmpty'=>false,'className'=>'Language', 'attributeName' => 'languages_id', 'message'=>Yii::t('validation', 'Неверное значение для поля')),

           // array('passwordConfirm', 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('validation', "Passwords don't match")),
           // array('newPassword, password_strategy ', 'length', 'max' => 50, 'min' => 8),
           // array('email, password, salt', 'length', 'max' => 255),
          //  array('requires_new_password, login_attempts', 'numerical', 'integerOnly' => true),
         //   // The following rule is used by search().
            // Please remove those attributes that should not be searched.
         //   array('id, username, email', 'safe', 'on' => 'search'),
        ];
    }



//
//    public function setAllData($data,$safe = true) {
//        if(!is_array($data))
//            return;
//        foreach ($data as $k=>$v)
//        {
//            $this->{$k}=$v;
//        }
//        $this->setAttributes($data,$safe);
//        $this->_allData=$data;
//        //print_r($this); exit;
//    }

    protected function afterDelete() {
        parent::afterDelete();
        //print_r($this->categories_id);exit;
        ShopCategoriesDescriptionLegacy::model()->deleteAll('categories_id=:id', array(':id' => $this->categories_id));
    }

    /**
     * Перекрываем встроенный метод АР для сохранения всех связанных таблиц (в данном случае categories_description)
     */
//    protected function afterSave() {
//        parent::afterSave();
//        if(!empty($this->_allData)){
//            $id = $this->_allData['categories_id'] = $this->categories_id;
//            foreach($this->relations() as $value){
//                // имя класса АР
//                $r_class = $value[1];
//                $r_relation_id = $value[2];
//
//                if (!$r_model = parent::model($r_class)->find($r_relation_id.'=:id', [':id' => $id])){
//                    // пример как делали раньше
//    //                $description = new ShopCategoriesDescriptionLegacy();
//
//                    // todo: может быть проблемой! (после проверки, удалить заметку и комментарий)
//                    // если выкидывает ошибку или странно сохраняет - переписать под
//                    // создание нового экземпляра класса АР
//
//    //                $r_model = parent::model($r_class);
//                    $r_model = new $r_class('add');
//                }
//
//                if ($r_model){
//                    $r_model->setAttributes($this->_allData, false);
////                    print_r($r_model);exit;
//                    $r_model->save();
//                }
//            }
//        }
//    }

    public function behaviors()
    {
        return array(
            'withRelated'=>array(
                'class'=>'common.extensions.behaviors.WithRelatedBehavior',
            ),
        );
    }

//    public function validate($attributes=null, $clearErrors=true){
//        parent::validate($attributes, $clearErrors);
//        $this->description->
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
