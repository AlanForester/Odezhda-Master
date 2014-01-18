<?php
/**
 * Top menu definition.
 *
 * @var BackendController $this
 */
//Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/adminlogin.css');
$this->widget(
    'bootstrap.widgets.TbNavbar',
    array(
        //'type' => 'inverse',
        //        'class'=>'container-fluid',
        'color' => TbHtml::NAVBAR_COLOR_INVERSE,
        'brandLabel' => 'Cpanel',
        //        'brandUrl' => Yii::app()->request->baseUrl.'/site/index',
        //        'display' => null,
        'fluid' => true,
        'collapse' => true,
        //        'htmlOptions'=>[
        //            'class'=>'container-fluid'
        //        ],
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbNav',
                'items' => array(
                    array(
                        'label' => 'Система',
                        'url' => '#',
                        //                        'class'=>'divider-vertical',
                        'items' => array(
                            array(
//                                                                'class' => 'bootstrap.widgets.TbNav',
                                'label' => 'Пользователи',
//                                'htmlOptions'=>[
//                                    'data-toggle'=>'dropdown-toggle',
//                                ],
                                'url' => array('/users/index'),
//                                'items' => [
//                                    [
//                                        'label' => 'Добавить пользователя',
//                                        'url' => array('/users/add'),
//                                        'activateParents'=>true
//                                    ]
//                                ]
                            ),
                            array('label' => 'Группы пользователей', 'url' => array('/groups/index')),
                            TbHtml::menuDivider(),
                            array('label' => 'Настройки', 'url' => array('/config/index')),
                        )
                    ),
                    array(
                        'label' => 'Разделы',
                        'url' => '#',
//                        'class' => 'divider-vertical',
                        'items' => array(
                            array('label' => 'Каталог', 'url' => array('/catalog/index')),
                            array('label' => 'Статьи', 'url' => array('/articles/index')),
                            array('label' => 'Информационные страницы', 'url' => array('/articles/index')),
                            array('label' => 'Бухгалтерия', 'url' => array('/articles/index')),
                            array('label' => 'Новости', 'url' => array('/articles/index')),
                            array('label' => 'FAQ', 'url' => array('/articles/index')),
                            array('label' => 'Модули', 'url' => array('/articles/index')),
                            array('label' => 'Сертификаты, купоны', 'url' => array('/articles/index')),
                            array('label' => 'Клиенты', 'url' => array('/articles/index')),
                            array('label' => 'Опросы', 'url' => array('/articles/index')),
                            array('label' => 'Партнеры', 'url' => array('/articles/index')),
                            array('label' => 'Места, налоги', 'url' => array('/articles/index')),
                            array('label' => 'Ссылки', 'url' => array('/articles/index')),
                            array('label' => 'Отчеты', 'url' => array('/articles/index')),
                            array('label' => 'Инструменты', 'url' => array('/articles/index')),
                        )
                    )
                ),
            ),
            [
                'class' => 'bootstrap.widgets.TbNav',
                'htmlOptions' => [
                    'class' => 'pull-right nav',
                ],
                'items' => array(
                    array(
                        'label' => Yii::app()->user->name,
                        'url' => '#',
                        //                        'class' => 'pull-right nav',
                        'items' => array(
                            array('label' => 'Учетная запись', 'url' => array('/catalog/index')),
                            TbHtml::menuDivider(),
                            array('label' => 'Выход', 'url' => array('/site/logout')),
                        )
                    ),
                )
            ]
        ),
    )
);
