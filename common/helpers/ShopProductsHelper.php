<?php

class ShopProductsHelper {

    private static $dataProvider;

    private static $errors = [];

    //    public static function getModel() {
    //        return InfoPage::model();
    //    }

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
                'product_options' => 'product_options'
            ]
        ];

        // разрешаем перезаписать любые параметры критерии
        if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }

        // todo: вынести в конфиг
        $page_size = 9;
        return new CActiveDataProvider(
            'ShopProduct',
            [
                'criteria' => $criteria,
                'pagination' => ($page_size == 'all' ? false : ['pageSize' => $page_size, 'currentPage' => $data['current_page']]),
            ]
        );
    }

    public static function getErrors($attributes = null) {
        return self::$errors;
    }
}