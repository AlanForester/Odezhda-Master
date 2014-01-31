<?php

/**
 * This is the model class for table "{{categories}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $categories_id
=
 *
 */
class CatalogLegacy extends CActiveRecord
{
    public $products_id;
    public $image;

    public $primaryKey='products_id';

    // здесь мы храним ВСЮ информацию, пришедшую на сохранение
    // и для основной таблице и для связанных
    protected $_allData = [];

    /**
     * Name of the database table associated with this ActiveRecord
     * @return string
     */
    public function tableName()
    {
        return 'products';
    }


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    public function relations()
    {
//        return array(
//            'description'=>array(self::HAS_ONE, 'CatalogDescriptionLegacy', 'products_id'),
//            'category_to_catalog' => array(self::HAS_MANY, 'CatalogToCategoriesLegacy', 'products_id'),
//            'categories_description' => array(self::HAS_MANY, 'ShopCategoriesDescriptionLegacy', 'categories_id', 'through' => 'CatalogToCategoriesLegacy')
//        );
        return array(
            'description'=>array(self::HAS_ONE, 'CatalogDescriptionLegacy', 'products_id'),
            'manufacturers'=>array(self::BELONGS_TO, 'ManufacturersInfoLegacy', 'manufacturers_id'),

            //связь с производителями  many to many (но выбирается только один производитель)
//            'catalog_to_manufacturers'=>array(self::HAS_MANY, 'CatalogToManufacturersLegacy', 'products_id'),
//            'manufacturers'=>array(self::HAS_MANY, 'ManufacturersInfoLegacy', 'manufacturers_id', 'categories_id', 'through' => 'category_to_catalog'),

            //связь с категориями many to many
            'category_to_catalog' => array(self::HAS_MANY, 'CatalogToCategoriesLegacy', 'products_id'),
            'categories_description' => array(self::HAS_MANY, 'ShopCategoriesDescriptionLegacy', 'categories_id', 'through' => 'category_to_catalog')
        );
    }

    protected function afterSave() {
        parent::afterSave();

        // TODO: БК
        $id = $this->_allData['products_id'] = $this->products_id;
        if(!empty($this->_allData['categories_name'])){
            $categories_data=$this->_allData['categories_name'];

            /**
             * Сохранение категорий
             */
            CatalogToCategoriesLegacy::model()->deleteAll('products_id=:id', array(':id' => $id));
            // todo: переписать через save
            foreach($categories_data as $category_id){
                if(!empty($category_id)){

                    $command_cr = Yii::app()->db->createCommand();

                    $command_cr->insert('products_to_categories',
                        [
                            'products_id'=>$id,
                            'categories_id'=>$category_id,
                        ]
                    );
                }
            }
        }


        //todo: БЮ Очистка ненежных связей перед сохранением
        $this->_allData['categories_name']='';
        $relations=$this->relations();
        unset($relations['manufacturers']);


        foreach($relations as $value){

            // имя класса АР
            $r_class = $value[1];
            $r_relation_id = $value[2];

            if (!$r_model = parent::model($r_class)->find($r_relation_id.'=:products_id', [':products_id' => $id])){
                // пример как делали раньше
//                $description = new ShopCategoriesDescriptionLegacy();

                // todo: может быть проблемой! (после проверки, удалить заметку и комментарий)
                // если выкидывает ошибку или странно сохраняет - переписать под
                // создание нового экземпляра класса АР

//                $r_model = parent::model($r_class);
                $r_model = new $r_class('add');
            }

            if ($r_model){
                $r_model->setAttributes($this->_allData, false);
                $r_model->save();
            }
        }



        // обновляем все зависимые таблицы, типа категорий
        /*
         * здесь мы делаем: удаляем из всех таблиц, типа  products_to_categories
         * все записи, у которых значение products_id = $id
         * DELETE FROM products_to_categories WHERE products_id = $id
         *
         * и по новой вставляем все наши связи с категориями данного продукта
         */
        //        $command = Yii::app()->db->createCommand();
        //        $command->delete('products_description', 'products_id=:id', array(':id'=>$id));
    }

    protected function afterDelete() {
        $id = $this->_allData['products_id'] = $this->products_id;

        CatalogDescriptionLegacy::model()->deleteAll('products_id=:id', array(':id' => $id));
        CatalogToCategoriesLegacy::model()->deleteAll('products_id=:id', array(':id' => $id));
//        $command = Yii::app()->db->createCommand();
//        $command->delete('products_description', 'products_id=:id', array(':id'=>$id));
    }
    /**
     * Закидываем все параметры для сохранения, как для основной таблицы, так и для связанных
     * @param array $data массив данных
     * @param bool $safe использовать безопасные данные
     */
    public function setAllData($data,$safe = true) {
        if(!is_array($data))
            return;

        $this->setAttributes($data,$safe);
        $this->_allData=$data;
    }




//    public function behaviors()
//    {
//        return array(
//            'withRelated'=>array(
//                'class'=>'common.extensions.behaviors.WithRelatedBehavior',
//            ),
//        );
//    }

}
