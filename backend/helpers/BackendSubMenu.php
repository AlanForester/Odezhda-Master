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

                ]
            ];
    }

    public static function retailOrder($id) {
        return
            [
                [
                    'label' => 'Информация о заказе',
                    'url' => ['/retail_orders/edit/'.$id],
                    'strict' => false
                ],
                [
                    'label' => 'Продукты в заказе',
                    'url' => ['/retail_orders_products/order/'.$id],
                    'strict' => false
                ],
            ];
    }

}