<?php

/**
 * Class BackendSubMenu
 * Генератор массива пунктов для под-меню
 */
class BackendSubMenu {

    /**
     * Управление пользователями, группами и правами доступа
     * @return array
     */
    public static function users() {
        return
            [
                [
                    'label' => 'Пользователи',
                    'url' => ['/users/index']
                ],
                [
                    'label' => 'Группы',
                    'url' => ['/groups/index']
                ],
                [
                    'label' => 'Права доступа',
                    'url' => ['/roles/index'],
                    'disabled' => true
                ],
            ];
    }

    /**
     * Управление покупателями и группами покупателей
     * @return array
     */
    public static function customers() {
        return
            [
                [
                    'label' => 'Покупатели',
                    'url' => ['/customers/index']
                ],
                [
                    // todo: лишнее?
                    'label' => 'Группы покупателей',
                    'url' => ['/customer_groups/index']
                ],
            ];
    }

    /**
     * Разделы магазина
     * @return array
     */
    public static function shop() {
        return
            [
                [
                    'label' => 'Товары',
                    'url' => ['/catalog/index']
                ],
                [
                    'label' => 'Категории',
                    'url' => ['/categories/index'],

                ],
                [
                    'label' => 'Клиенты',
                    'url' => ['/customers/index'],

                ]
            ];
    }

    /**
     * Разделы розничного магазина
     * @return array
     */
    public static function retail() {
        return
            [
                [
                    'label' => 'Розничные заказы',
                    'url' => ['/retail_orders/index']
                ],
                [
                    'label' => 'Отделения доставки',
                    'url' => ['/retail_delivery/index'],

                ]
            ];
    }

//    public static function retailOrder($id) {
//        return
//            [
//                [
//                    'label' => 'Информация о заказе',
//                    'url' => ['/retail_orders/edit/'.$id],
//                    'strict' => false
//                ],
//                [
//                    'label' => 'Товары в заказе',
//                    'url' => ['/retail_orders_products/order/'.$id],
//                    'strict' => false
//                ],
//            ];
//    }

}