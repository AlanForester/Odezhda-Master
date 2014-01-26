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
                    'label' => 'Категории',
                    'url' => ['/categories/index'],

                ],
                [
                    'label' => 'Каталог',
                    'url' => ['/catalog/index']
                ]
            ];
    }

}