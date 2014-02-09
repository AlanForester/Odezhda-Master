<?php

/**
 * This is the model class for table "{{pages}}".
 *
 * The followings are the available columns in table '{{pages}}':
 * @property integer $pages_id
 * @property string $pages_image
 * @property integer $sort_order
 * @property datetime $pages_date_added
 * @property datetime $pages_last_modified
 * @property integer $pages_status

 *
 */
class InfoPage extends LegacyActiveRecord {

//    public function afterConstruct(){
//        $relations=$this->relations();
//
//        if (!empty($relations)){
//            foreach($relations as $r_name => $r_value){
//                $this->{$r_name} = new $r_value[1];
//            }
//        }
//    }

//    public $primaryKey = 'id';

    public function __get($name) {
        $relations=$this->relations();
        if(!empty($relations)){
            foreach ($relations as $relName => $relData){
                if(!$this->hasRelated($relName))
                    continue;

                $relation = $this->getRelated($relName);
//                $is_column = isset($relation->getMetaData()->columns[$name]);

                $rel_name = $relation->getFieldMapName($name,false);
                $columns = $relation->getMetaData()->columns;
                // проходим ТОЛЬКО при наличии такого поля в бд связанной таблицы
                if (array_key_exists($rel_name,$columns)){
                    return $relation->{$name};
                }

            }
        }

        return parent::__get($this->getFieldMapName($name, false));
    }

    public function __isset($name) {
        $relations=$this->relations();
        if(!empty($relations)){
            foreach ($relations as $relName => $relData){
                if(!$this->hasRelated($relName))
                    continue;

                $relation = $this->getRelated($relName);
                if (isset($relation->{$name})){
                    return true;
                }
            }
        }

        return parent::__isset($this->getFieldMapName($name, false));
    }

    /**
     * Замена имени поля в подстроке по маске "[[new]]" => "old"
     * @param mixed $data исходные данные. может быть массивом, обьектом или строкой
     * @return mixed
     */
    public function getFieldMapQuery($data) {
        switch (gettype($data)) {
            case 'array':
            case 'object':
                foreach ($data as &$d) {
                    $d = $this->getFieldMapQuery($d);
                }
                break;

            case 'string':
                $data = preg_replace_callback(
                    '/(\[\[(.*)\]\])/isU',
                    function ($m) {
                        //todo забито гвоздями - переделать
                        //сделано для предотвращения конфликта одинаковых полей id в связанных таблицах
                        $alias='';
                        if($m[2]=='id'){
                            $alias='t.';
                        }

                        $relations=$this->relations();
                        if(!empty($relations)){
                            foreach ($relations as $relName => $relData){
                                $relClass=$relData[1];
                                $result = $relClass::model()->getFieldMapName($m[2], false);
                                if ($result!=$m[2]){
                                    return $alias.$result;
                                }
                            }
                        }
                        return $alias.$this->getFieldMapName($m[2], false);
                    },
                    $data
                );
                break;
        }
        return $data;
    }

    public function tableName() {
        return 'pages';
    }

    /**
     * @return array карта полей бд (которые нужно перевернуть)
     */
    public function fieldMap() {
        return [
            'pages_id' => 'id',
            'pages_image' => 'image',
            'pages_date_added' => 'added',
            'pages_status' => 'status',
            'pages_last_modified' => 'modified',
            'sort_order' => 'sort_order',
        ];
    }
    //--------------------------------------
    /**
     * Правила проверки полей модели
     * @see http://www.yiiframework.com/wiki/56/
     * @return array
     */
    public function getRules() {
        $result = [];
        $relations=$this->relations();
        if(!empty($relations)){
            foreach ($relations as $relName => $relData){
//                if(!$this->hasRelated($relName))
//                    continue;
                $relClass=$relData[1];
//                $result = array_merge($result,$this->getRelated($relName)->getRules());
                $result = array_merge($result,$relClass::model()->getRules());
            }
        }
        return array_merge($result,[
            ['status', 'boolean', 'message'=>Yii::t('validation', 'Неверное значение поля')],
            ['sort_order', 'numerical', 'message' => Yii::t('validation', "Поле должно быть числовым")],
            ['sort_order', 'length', 'max' => 3, 'message'=>Yii::t('validation', 'Слишком большое число (максимум 999)')],
        ]);
    }

    /**
     * Заголовки полей (поле=>заголовок)
     * @return array
     */
    public function attributeLabels() {
        $result = [];
        $relations=$this->relations();
        if(!empty($relations)){
            foreach ($relations as $relName => $relData){
//                if(!$this->hasRelated($relName))
//                    continue;
                $relClass=$relData[1];

                //$result = array_merge($result,$this->getRelated($relName)->attributeLabels());
                $model = call_user_func([$relClass,'model']);
                $result = array_merge($result,$model->attributeLabels());
            }
        }

        return array_merge($result,[
            'id' => Yii::t('labels', 'ID'),
            'sort_order' => Yii::t('labels', 'Порядок сортирвки'),
            'status' => Yii::t('labels', 'Статус'),
            'modified' => Yii::t('labels', 'Изменена'),
            'added' => Yii::t('labels', 'Создана'),
            'image' => Yii::t('labels', 'Изображение'),
        ]);
    }

    public function relations() {
        return [
            'page_description' => [self::HAS_ONE, 'InfoPageDescription', 'pages_id'],
        ];
    }

    /**
     * Перекрываем родительский метод. Устанавливаем атрибуты еще и в связанных АР
     * @param array $values массив данных для установки
     * @param bool $safeOnly только безопасные атрибуты
     */
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

    /**
     * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     * @param string $className
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
