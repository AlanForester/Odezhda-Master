<?php

class ProductNewOptions extends LegacyActiveRecord {


    public function tableName() {
        return 'products_new_option_values';
    }


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function fieldMap() {
        return [
            'value' =>'name'
        ];
    }

    public function relations() {
        return [
            //связь с опциями
           // 'products_to_new_options' => array(self::HAS_MANY, 'ProductOldToNewOptions', 'products_options_values_id', 'together' => true),
            //'products_new_option_values' => array(self::HAS_ONE, 'ProductNewOptions', 'products_new_value_id', 'through' => 'products_to_new_options', 'together' => true)
        ];
    }

    public function defaultScope() {
        return [
//            'with' => [
//                'products_new_option_values'
//            ]
        ];
    }

    public function getRules() {
        return array_merge([
//            ['name', 'unique', 'message' => Yii::t('validation', "E-mail должен быть уникальным")],
            ['name', 'required', 'message' => Yii::t('validation', 'Является обязательным')]
        ]);
    }

    public function setAttributes($values, $safeOnly = true) {
        parent::setAttributes($values, $safeOnly);
        $relations=$this->relations();
        if (!empty($relations)){
            foreach($relations as $relName => $relData){
                $this->{$relName}->setAttributes($values,$safeOnly);
            }
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


    public function behaviors(){
        return [
            'withRelated'=>array(
                'class'=>'common.extensions.behaviors.WithRelatedBehavior',
            ),
        ];
    }
}
