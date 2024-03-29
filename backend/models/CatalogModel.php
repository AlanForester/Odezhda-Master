<?php

/**
 * Class CatalogModel - работа с группамми пользователей
 *
 */
class CatalogModel extends CFormModel {


    public $id;

    public $price;
    public $old_price;

    public $name;
    public $description;
    public $model;
    public $category;
    public $date_add;
    public $date_last;

    public $tax;
    public $count_orders;
    public $quantity;
    public $weight;

    public $order;

    public $min_quantity;
    public $step;
    public $status;
    public $xml;

    public $manufacturers;
    public $manufacturers_id;

    public $languages_id;

    public $meta_title;
    public $meta_description;
    public $meta_keywords;

    public $image;



    /**
     * @var array массив всех пользователей.
     * Значение каждого элемента массива - массив с атрибутами пользователя(поля из БД)
     */
    private $list = [];
    private $allCatalog = [];





    public function getListAndParams($data) {

        if (!$this->allCatalog) {

            $condition = ['main'=>[],'description'=>[],'category_to_catalog'=>[],'categories_description'=>[]];
            $params = ['main'=>[],'description'=>[],'category_to_catalog'=>[],'categories_description'=>[]];


            // фильтр по тексту
            if (!empty($data['text_search'])) {
            //    по основной таблице
                $condition['main'][] = '(' . join(
                        ' OR ',  [
                             't.'.CatalogLayer::getFieldName('id', false) . ' LIKE :text',
                             't.'.CatalogLayer::getFieldName('price', false) . ' LIKE :text',
//
                            'description.'.CatalogLayer::getFieldName('name', false) . ' LIKE :text',
                            'description.'.CatalogLayer::getFieldName('description', false) . ' LIKE :text'
                            ]

                             ) . ')';

                $params['main'][':text'] = '%' . $data['text_search'] . '%';




            }






            // поле и направление сортировки
            $order_direct = null;
            $order_field = 't.'.CatalogLayer::getFieldName('id', false);

            if(!empty($data['order_field'])){

                if($data['order_field']=='name'){
                    $order_field = 'description.'.CatalogLayer::getFieldName($data['order_field'], false);
                }
                elseif($data['order_field']=='manufacturers'){
                    $order_field = 'manufacturers.'.CatalogLayer::getFieldName($data['order_field'], false);
                }
                else{
                    $order_field = 't.'.CatalogLayer::getFieldName($data['order_field'], false);
                }
              }


            if (isset($data['order_direct'])) {
                switch ($data['order_direct']) {
                    case 'up':
                        $order_direct = ' ASC';
                        break;
                    case 'down':
                        $order_direct = ' DESC';
                        break;
                }
                }else{
                    $order_direct = ' ASC';
                }


            // фильтр по группе
            if (!empty($data['filter_category'])) {
                $condition['categories_description'][] = 'categories_description.categories_id' . '=:categories_id';
                $params['categories_description'][':categories_id'] = $data['filter_category'];
            }

            $this->allCatalog = CatalogLayer::getListAndParams(
                //Основные
               ['main'=> [
                    'condition' => join(' AND ', $condition['main']),
                    'params' => $params['main'],
                    'order' => $order_field . ($order_direct ? : '')
                ],
                //Описание
                   'description'=> [
                    'condition' => join(' AND ', $condition['description']),
                    'params' => $params['description']
                ],
                //Категории
               'categories_description'=> [
                    'condition' => join(' AND ', $condition['categories_description']),
                    'params' => $params['categories_description']
                ]]
            );

        }
        return $this->allCatalog;
    }





    /**
     * @return array задает возвращает массив всех групп пользователей
     */
    public function getList() {
        if (!$this->list) {
            $this->list = CatalogLayer::getList();
        }
        return $this->list;
    }


    public function getCatalog($id, $scenario) {
        return CatalogLayer::getCatalog($id, $scenario);
    }

    public function getCatalogData($id, $scenario) {


        $catalog = self::getCatalog($id, $scenario);

        if($scenario!='add'){

            $result = $catalog->attributes + $catalog->description->attributes;
            if(!empty($catalog->manufacturers->attributes)){
                $result += $catalog->manufacturers->attributes;
            }
            /**
             * Формирование массива используемых категорий в соответствующем формате [categories_id]=['selected']
             */
            $mass=[];
            foreach($catalog->categories_description as $array){
                if(!empty($array)){
                     $mass[$array->attributes['categories_id']] = ['selected'=>'selected'];
                }
            }
            $result['categories_id']=$mass;


            $mass=[];
            foreach($catalog->catalog_options_values as $array){
                if(!empty($array)){
                    $mass[$array->attributes['products_options_values_id']] = ['selected'=>'selected'];
                }
            }
            $result['products_options_values_id']=$mass;


            // todo: Написать цикл для заполнения полей  $catalog->categories_description[0]->attributes

        }
        else{

            $result = $catalog->attributes;
            $result['categories_id']=[];
        }

//            echo '<pre>';
//            print_r($result);
//           exit;
        return ($catalog ? CatalogLayer::fieldMapConvert($result) : false);
    }

    public function save($data) {
        return CatalogLayer::save($data);
    }

    public function rules() {
        return CatalogLayer::rules();
    }

    public function validate($attributes = null, $clearErrors = true) {
        return CatalogLayer::validate($attributes, $clearErrors);
    }

    public function getErrors($attributes = null) {
        return CatalogLayer::getErrors($attributes);
    }

    public function delete($id) {
        return CatalogLayer::delete($id);
    }

    public function updateField($params = []) {
        return CatalogLayer::updateField($params);
    }

}
