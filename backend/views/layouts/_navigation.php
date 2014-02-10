<?php
/**
 * Top menu definition.
 *
 * @var BackendController $this
 */
//Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/adminlogin.css');
$this->widget(
    'bootstrap.widgets.TbNavbar',
    [
        'color' => TbHtml::NAVBAR_COLOR_INVERSE,
        'brandLabel' => 'Cpanel',
        //        'brandUrl' => Yii::app()->request->baseUrl.'/site/index',
        //        'display' => null,
        'fluid' => true,
        'collapse' => true,
        'items' => [
            [
                'class' => 'bootstrap.widgets.TbNav',
                'items' => [
                    [
                        'label' => 'Система',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Панель управления',
                                'url' => ['/site/index'],
                            ],
                            TbHtml::menuDivider(),
                            [
                                'label' => 'Пользователи',
                                'url' => ['/users/index'],
                            ],
                            [
                                'label' => 'Группы пользователей',
                                'url' => ['/groups/index']
                            ],
                            [
                                'label' => 'Уровни доступа',
                                'url' => ['/rules/index'],
                                'disabled'=>true
                            ],
                            TbHtml::menuDivider(),
                            [
                                'label' => 'Общие параметры',
                                'url' => ['/config/index'],
                                'disabled'=>true
                            ],
                            [
                                'label' => 'Информация о системе',
                                'url' => ['/config/index'],
                                'disabled'=>true
                            ]
                        ]
                    ],
                    [
                        'label' => 'Материалы',
                        'url' => '#',
                        'items'=>[
                            [
                                'label' => 'Статьи',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ],
                            [
                                'label' => 'Информационные страницы',
                                'url' => ['/info_pages/index'],
                            ],
                            [
                                'label' => 'Новости',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ],
                            [
                                'label' => 'FAQ',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ],
                        ]
                    ],
                    [
                        'label' => 'Магазин',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Товары',
                                'url' => ['/catalog/index']
                            ],
                            [
                                'label' => 'Категории',
                                'url' => ['/categories/index']
                            ],
                            [
                                'label' => 'Розничные заказы',
                                'url' => ['/retail_orders/index']
                            ],
                            [
                                'label' => 'Бухгалтерия',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ],
                            [
                                'label' => 'Модули',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ],
                            [
                                'label' => 'Сертификаты, купоны',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ],
                            [
                                'label' => 'Клиенты',
                                'url' => ['/customers/index'],
                            ],
                            [
                                'label' => 'Партнеры',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ],
                            [
                                'label' => 'Места, налоги',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ]
                        ]
                    ],
                    [
                        'label' => 'Разное',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Опросы',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ],
                            [
                                'label' => 'Ссылки',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ],
                            [
                                'label' => 'Отчеты',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ],
                            [
                                'label' => 'Инструменты',
                                'url' => ['/articles/index'],
                                'disabled'=>true
                            ],
                        ]
                    ]
                ],
            ],
            [
                'class' => 'bootstrap.widgets.TbNav',
                'htmlOptions' => [
                    'class' => 'pull-right nav',
                ],
                'items' => [
                    [
                        'label' => Yii::app()->user->name,
                        'url' => '#',
                        'menuOptions'=>[
                            'class'=>'user-menu'
                        ],
                        'items' => [
                            [
                                'label' => 'Учетная запись',
                                'url' => ['/catalog/index'],
                                'icon'=>'icon-user',
                                'disabled'=>true
                            ],
                            [
                                'label' => 'Настройки',
                                'url' => ['/catalog/index'],
                                'icon'=>'icon-cog',
                                'disabled'=>true
                            ],
                            TbHtml::menuDivider(),
                            [
                                'label' => 'Выход',
                                'url' => ['/site/logout'],
                                'icon'=>'icon-off'
                            ],
                        ]
                    ],
                ]
            ]
        ],
    ]
);
