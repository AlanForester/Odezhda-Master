<?php

/**
 * Class CatalogModel - работа с группамми пользователей
 *
 */
class CatalogModel extends CFormModel {


    public $id;
    public $price;
    public $name;
    public $description;
    public $category;

    /**
     * @var array массив всех пользователей.
     * Значение каждого элемента массива - массив с атрибутами пользователя(поля из БД)
     */
    private $list = [];
    private $allCatalog = [];





    public function getListAndParams($data) {

        if (!$this->allCatalog) {

            $condition = [];
            $params = [];

            // фильтр по тексту
            if (!empty($data['text_search'])) {

                $condition[] = '(' . join(
                        ' OR ',  [
                             '`description`.`'.CatalogLayer::getFieldName('id', false) . '` LIKE :text',
                            '`t`.`'.CatalogLayer::getFieldName('price', false) . '` LIKE :text',
                            '`description`.`'.CatalogLayer::getFieldName('name', false) . '` LIKE :text',
                            '`description`.`'.CatalogLayer::getFieldName('description', false) . '` LIKE :text'
                            ]

                                 ) . ')';

                $params[':text'] = '%' . $data['text_search'] . '%';
            }
//       print_r($condition);
//        exit;
            // поле и направление сортировки
            $order_direct = null;

            $order_field = '`description`.`'.CatalogLayer::getFieldName(!empty($data['order_field']) ? $data['order_field'] : 'products_id', false).'`';
 /*           echo $data['order_field'];
            exit;*/
            //$order_field=null;

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


            $this->allCatalog = CatalogLayer::getListAndParams(
                [
                    'condition' => join(' AND ', $condition),
                    'params' => $params,
                    'order' => $order_field . ($order_direct ? : '')
                ]
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
        $Catalog = self::getCatalog($id, $scenario);

        if($scenario!='add'){
            $result = $Catalog->attributes + $Catalog->description->attributes;
        }
        else{
            $result = $Catalog->attributes;
        }

//            echo '<pre>';
//            print_r($result);
//            exit;
        return ($Catalog ? CatalogLayer::fieldMapConvert($result) : false);
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
