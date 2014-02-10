<?php

class ShopProductsHelper {

    //    private static $dataProvider;

    //    private static $errors = [];

    public static function getModel() {
        return ShopProduct::model();
    }

    public static function getDataProvider($data = null) {
        $condition = [];
        $params = [];

        // фильтр по категории
        if (isset($data['category'])) {
            // todo: решить проблему с подстановкой имени связанной таблицы
            $condition [] = 'categories_description.categories_id =:category';
            $params[':category'] = $data['category'];
        }

        $criteria = [
            'condition' => join(' AND ', $condition),
            'params' => $params,
//            'with'=>[
//                'categories_description'
//            ]
            //            'order' => $order_field . ($order_direct ? : ''),
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
                'pagination' => ['pageSize' => 12],
                //                'pagination' => ['pageSize' => 9, 'currentPage' => $data['page']],
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