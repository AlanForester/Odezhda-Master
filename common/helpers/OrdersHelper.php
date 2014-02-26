<?php
/**
 * Created by PhpStorm.
 * User: Zimovid
 * Date: 26.02.14
 * Time: 15:20
 */

class OrdersHelper {
    public static function getModel() {
        return Orders::model();
    }
    public static function getDataProvider($data = null){
        $condition = [];
        $params = [];
        // поле и направление сортировки
        $order_direct = null;
        $order_field = '[[' . (!empty($data['order_field']) ? $data['order_field'] : 'firstname') . ']]';

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

        $page_size = TbArray::getValue('page_size', $data, CPagination::DEFAULT_PAGE_SIZE);

        $criteria = [
            'condition' => join(' AND ', $condition),
            'params' => $params,
            'order' => $order_field . ($order_direct ? : ''),
        ];

        // разрешаем перезаписать любые параметры критерии
        if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }

        return new CActiveDataProvider(
            'User',
            [
                'criteria' => $criteria,
                'pagination' => ($page_size == 'all' ? false : ['pageSize' => $page_size]),
            ]
        );
    }
} 