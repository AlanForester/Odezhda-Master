<?php

class ShopProductsHelper {

    //    private static $dataProvider;

    //    private static $errors = [];

    public static function getModel() {
        return ShopProduct::model();
    }

    public static function getDataProvider($data = null) {
        // todo: епт, что это ??
        // фильтр по группе
        $data['categories_description'] = [];

        if ($data['current_category'] != 0) {
            $data['categories_description'] = [
                'condition' => 'categories_description.categories_id' . '=:categories_id',
                'params' => [':categories_id' => $data['current_category']]
            ];
        }

        $criteria = [
            'order' => 't.products_id ASC',
            // todo: ну и зачем тут явное указание связанной таблицы?
            'with' => [
                'product_description' => 'product_description' /*$relatedCriteria*/,
                'manufacturers_description' => 'manufacturers_description' /*$relatedCriteria*/,
                'categories_description' => $data['categories_description'],
                // todo: источник ошибки пагинации
                //                'product_options' => 'product_options'
            ]
        ];

        // разрешаем перезаписать любые параметры критерии
        if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }

        return new CActiveDataProvider(
            'ShopProduct',
            [
                'criteria' => $criteria,
                // todo: вынести в конфиг pageSize
                'pagination' => ['pageSize' => 9, 'currentPage' => $data['current_page']],
            ]
        );
    }

    public static function getProduct($id = null, $scenario = null) {
        if ($id) {
            // todo: вынести код в АР
            if (!$page = self::getModel()->findByPk($id)) {
                return false;
            }
            $relations = $page->relations();
            if (!empty($relations)) {
                foreach ($relations as $r_name => $r_value) {
                    if (empty ($page->{$r_name})) {
                        $r_class = $r_value[1];
                        $page->{$r_name} = new $r_class();
                    }
                }
            }
        } else {
            $page = new ShopProduct($scenario);
            $relations = $page->relations();
            if (!empty($relations)) {
                foreach ($relations as $r_name => $r_value) {
                    $page->{$r_name} = new $r_value[1];
                }
            }
        }
        return $page;
    }

    //    public static function getErrors($attributes = null) {
    //        return self::$errors;
    //    }
}