<?php

class ProductNewOptions extends LegacyActiveRecord {

    public static $oldSizeString;
    public static $oldSizesList=[];
    public static $rel_old_list;
    protected $_allData = [];
    public function __get($name) {

        $relations = $this->relations();
        if (!empty($relations)) {

            foreach ($relations as $relName => $relData) {
                if (!$this->hasRelated($relName))
                    continue;

                $relation = $this->getRelated($relName);
                if (is_array($relation)) {
                    foreach ($relation as $rel) {
                        if (method_exists($rel, 'getFieldMapName')) {
                            $rel_name = $rel->getFieldMapName($name, false);
                            $columns = $rel->getMetaData()->columns;

                            // проходим ТОЛЬКО при наличии такого поля в бд связанной таблицы
                            if (array_key_exists($rel_name, $columns)) {
                                return $rel->{$name};
                            }
                        }
                    }
                } else {
                    if (method_exists($relation, 'getFieldMapName')) {
                        $rel_name = $relation->getFieldMapName($name, false);
                        $columns = $relation->getMetaData()->columns;

                        // проходим ТОЛЬКО при наличии такого поля в бд связанной таблицы
                        if (array_key_exists($rel_name, $columns)) {
                            return $relation->{$name};
                        }
                    }
                }
            }
        }
        return parent::__get($this->getFieldMapName($name, false));
    }

    public function __isset($name) {

        $relations = $this->relations();
        if (!empty($relations)) {
            foreach ($relations as $relName => $relData) {
                if (!$this->hasRelated($relName))
                    continue;

                $relation = $this->getRelated($relName);
                if (isset($relation->{$name})) {
                    return true;
                }
            }
        }

        return parent::__isset($this->getFieldMapName($name, false));
    }

    public function tableName() {
        return 'products_new_option_values';
    }


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function fieldMap() {
        return [
            'products_new_value_id'=>'id',
            'value' =>'name'
        ];
    }

    public function relations() {
        return [
//            связь с опциями
           'products_to_new_options' => array(self::HAS_MANY, 'ProductOldToNewOptions', 'products_new_value_id', 'together' => false),
           'products_option_values' => array(self::HAS_MANY, 'ProductOptions', 'products_options_values_id', 'through' => 'products_to_new_options', 'together' => false),
         //  'products_option_values' => array(self::MANY_MANY, 'ProductOptions', 'products_to_new_options(products_options_values_id,products_new_value_id)', 'together' => false)
        ];
    }

    public function defaultScope() {
        return [
            'with' => [
                 //'products_to_new_options',
                 //'products_option_values'
            ]
        ];
    }

    public function getRules() {
        return array_merge([
//            ['name', 'unique', 'message' => Yii::t('validation', "E-mail должен быть уникальным")],
            ['name', 'required', 'message' => Yii::t('validation', 'Является обязательным')]
        ]);
    }

    //    public function setAttributes($values, $safeOnly = true) {
//        parent::setAttributes($values, $safeOnly);
//        $relations=$this->relations();
//        if (!empty($relations)){
//            foreach($relations as $relName => $relData){
//                $this->{$relName}->setAttributes($values,$safeOnly);
//            }
//        }
//    }

    public function setAttributes($values,$safeOnly=true)
    {

        if(!empty($values['rel_old_id'])){
            $this->oldSizesList=$values['rel_old_id'];
            unset($values['rel_old_id']);
        }

        if(!is_array($values))
            return;
        $attributes=array_flip($safeOnly ? $this->getSafeAttributeNames() : $this->attributeNames());
        foreach($values as $name=>$value)
        {
            if(isset($attributes[$name]))
                $this->$name=$value;
            elseif($safeOnly)
                $this->onUnsafeAttribute($name,$value);
        }
    }

    /**
     * Удаление всех связанных таблиц
     */
    protected function afterDelete() {
        parent::afterDelete();
        $relations=$this->relations();
        if(!empty($relations)){
            foreach ($relations as $relName => $relData){
//                $relClass=$relData[1];
//                $relClass::model()->deleteAll('id=:id', array(':id' => $this->id));
                if(!$this->hasRelated($relName))
                    continue;
                $this->getRelated($relName)->delete();
            }
        }
    }
    protected function afterSave() {
        //    parent::afterSave();
        if(!empty($this->oldSizesList)){ $list = $this->oldSizesList;}
        $id=$this->id;
        if(!empty($list)){
            ProductOldToNewOptions::model()->deleteAll('products_new_value_id=:products_new_value_id',[':products_new_value_id'=>$id]);
//            foreach($list as $key => $option){
//                Yii::app()->db->createCommand()->insert('products_to_new_options',
//                    [
//                        'products_options_values_id'=>$option,
//                        'products_new_value_id'=>$id,
//                    ]
//                );
//            }
        }
    }

    public function behaviors(){
        return [
            'withRelated'=>array(
                'class'=>'common.extensions.behaviors.WithRelatedBehavior',
            ),
        ];
    }
}
