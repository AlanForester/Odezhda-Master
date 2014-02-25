<?php

/**
 * Class CatalogModel - работа с группамми пользователей
 *
 */
class CatalogModel extends CFormModel {

    public function frontCatalogData() {

        $list = CatalogLayer::frontCatalogData(
            ['new_model' => [
                'order' => 't.' . CatalogLayer::getFieldName('id', false) . ' DESC',
            ],
            'old_model' => [
                'order' => 't.' . CatalogLayer::getFieldName('id', false) . ' ASC'
            ],
            'leaders' => [
                'order' => 't.' . CatalogLayer::getFieldName('count_orders', false) . ' DESC'
            ],
            'lapa' => [
                'order' => 't.' . CatalogLayer::getFieldName('id', false) . ' DESC',
                'condition' => 'categories_description.categories_id=48'
            ],
            'shoes' => [
                'order' => 't.' . CatalogLayer::getFieldName('id', false) . ' DESC',
                'condition' => 'categories_description.categories_id=931'
            ]]
        );

        return $list;
    }

    public function frontCatalogList($offset, $category_id) {
        // todo: разобраться и переделать метод

        $data['order_field'] = 't.' . CatalogLayer::getFieldName('id', false) . ' DESC';
        $data_categories = 'categories_description';
        $data['new_model'] = [];
        //        $params=[];
        // фильтр по группе
        if ($category_id != 0) {
            $data_categories = [];
            $data_categories['condition'] = 'categories_description.categories_id' . '=:categories_id';
            $data_categories['params'][':categories_id'] = $category_id;
        }

        $list_and_count = CatalogLayer::frontCatalogList(
            $offset,
            [
                'new_model' => [
                    'order' => $data['order_field']
                ],
                'categories_description' => $data_categories
            ], $category_id
        );


        return $list_and_count;
    }

    public function productById($id) {
        return ShopProductsHelper::getProduct($id);
    }

    public function getCategory($id){
        return ShopCategoriesLayer::getCategory($id);
    }

//    public function getListAndParams($data) {
//
//        if (!$this->allCatalog) {
//
//            $condition = ['main' => [], 'description' => [], 'category_to_catalog' => [], 'categories_description' => []];
//            $params = ['main' => [], 'description' => [], 'category_to_catalog' => [], 'categories_description' => []];
//
//
//            // фильтр по тексту
//            if (!empty($data['text_search'])) {
//                //    по основной таблице
//                $condition['main'][] = '(' . join(
//                        ' OR ', [
//                                  't.' . CatalogLayer::getFieldName('id', false) . ' LIKE :text',
//                                  't.' . CatalogLayer::getFieldName('price', false) . ' LIKE :text',
//                                  't.' . CatalogLayer::getFieldName('date_add', false) . ' LIKE :text',
//                                  't.' . CatalogLayer::getFieldName('date_last', false) . ' LIKE :text',
//                                  'description.' . CatalogLayer::getFieldName('name', false) . ' LIKE :text',
//                                  'description.' . CatalogLayer::getFieldName('description', false) . ' LIKE :text'
//                              ]
//
//                    ) . ')';
//
//                $params['main'][':text'] = '%' . $data['text_search'] . '%';
//
//            }
//
//            // поле и направление сортировки
//            $order_direct = null;
//            $order_field = 't.' . CatalogLayer::getFieldName('id', false);
//
//            if (!empty($data['order_field'])) {
//
//                if ($data['order_field'] == 'name') {
//                    $order_field = 'description.' . CatalogLayer::getFieldName($data['order_field'], false);
//                } elseif ($data['order_field'] == 'manufacturers') {
//                    $order_field = 'manufacturers.' . CatalogLayer::getFieldName($data['order_field'], false);
//                } else {
//                    $order_field = 't.' . CatalogLayer::getFieldName($data['order_field'], false);
//                }
//            }
//
//
//            if (isset($data['order_direct'])) {
//                switch ($data['order_direct']) {
//                    case 'up':
//                        $order_direct = ' ASC';
//                        break;
//                    case 'down':
//                        $order_direct = ' DESC';
//                        break;
//                }
//            } else {
//                $order_direct = ' ASC';
//            }
//
//
//            // фильтр по группе
//            if (!empty($data['filter_category'])) {
//                $condition['categories_description'][] = 'categories_description.categories_id' . '=:categories_id';
//                $params['categories_description'][':categories_id'] = $data['filter_category'];
//            }
//
//            $this->allCatalog = CatalogLayer::getListAndParams(
//            //Основные
//                ['main' => [
//                    'condition' => join(' AND ', $condition['main']),
//                    'params' => $params['main'],
//                    'order' => $order_field . ($order_direct ? : '')
//                ],
//                    //Описание
//                    'description' => [
//                        'condition' => join(' AND ', $condition['description']),
//                        'params' => $params['description']
//                    ],
//                    //Категории
//                    'categories_description' => [
//                        'condition' => join(' AND ', $condition['categories_description']),
//                        'params' => $params['categories_description']
//                    ]]
//            );
//
//        }
//        return $this->allCatalog;
//    }

    /**
     * @return array задает возвращает массив всех групп пользователей
     */
//    public function getList() {
//        if (!$this->list) {
//            $this->list = CatalogLayer::getList();
//        }
//        return $this->list;
//    }

//    public function getCatalog($id, $scenario) {
//        return CatalogLayer::getCatalog($id, $scenario);
//    }

//    public function getCatalogData($id, $scenario) {
//
//
//        $catalog = self::getCatalog($id, $scenario);
//
//        if ($scenario != 'add') {
//
//            $result = $catalog->attributes + $catalog->description->attributes;
//            if (!empty($catalog->manufacturers->attributes)) {
//                $result += $catalog->manufacturers->attributes;
//            }
//
//            // Формирование массива используемых категорий в соответствующем формате [categories_id]=['selected']
//            $mass = [];
//            foreach ($catalog->categories_description as $array) {
//                if (!empty($array)) {
//                    $mass[$array->attributes['categories_id']] = ['selected' => 'selected'];
//                }
//            }
//            $result['categories_id'] = $mass;
//
//
//            // todo: Написать цикл для заполнения полей  $catalog->categories_description[0]->attributes
//
//        } else {
//
//            $result = $catalog->attributes;
//            $result['categories_id'] = [];
//        }
//
//        return ($catalog ? CatalogLayer::fieldMapConvert($result) : false);
//    }

    public function getDataProvider($criteria = null,$pageSize=12) {
        return ShopProductsHelper::getDataProvider($criteria,$pageSize);
    }

    public function dayProduct($category) {
        return ShopProductsHelper::dayProduct($category);
    }



}
