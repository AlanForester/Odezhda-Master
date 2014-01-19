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
                                'label' => 'Пользователи',
                                'url' => ['/users/index'],
//                                'icon'=>TbHtml::ICON_USER
                            ],
                            [
                                'label' => 'Группы пользователей',
                                'url' => ['/groups/index'],
//                                'icon'=>'icon-group'
                            ],
                            TbHtml::menuDivider(),
                            [
                                'label' => 'Настройки',
                                'url' => ['/config/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'Разделы',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Каталог',
                                'url' => ['/catalog/index']
                            ],
                            [
                                'label' => 'Статьи',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Информационные страницы',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Бухгалтерия',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Новости',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'FAQ',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Модули',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Сертификаты, купоны',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Клиенты',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Опросы',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Партнеры',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Места, налоги',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Ссылки',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Отчеты',
                                'url' => ['/articles/index']
                            ],
                            [
                                'label' => 'Инструменты',
                                'url' => ['/articles/index']
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
                                'icon'=>'icon-user'
                            ],
                            [
                                'label' => 'Настройки',
                                'url' => ['/catalog/index'],
                                'icon'=>'icon-cog'
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
