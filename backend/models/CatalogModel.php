<?php

/**
 * Class CatalogModel - работа с группамми пользователей
 *
 */
class CatalogModel extends CFormModel {


    public $id;
    public $price;

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
                        ' OR ',  [ CatalogLayer::getFieldName('price', false) . ' LIKE :text']

                    ) . ')';

                $params[':text'] = '%' . $data['text_search'] . '%';
            }

            // поле и направление сортировки
            $order_direct = null;

            $order_field = CatalogLayer::getFieldName(!empty($data['order_field']) ? $data['order_field'] : 'id', false);
 /*           echo $data['order_field'];
            exit;*/

            if (isset($data['order_direct'])) {
                switch ($data['order_direct']) {
                    case 'up':
                        $order_direct = ' ASC';
                        break;
                    case 'down':
                        $order_direct = ' DESC';
                        break;
                }
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
        return ($Catalog ? CatalogLayer::fieldMapConvert($Catalog->attributes) : false);
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
