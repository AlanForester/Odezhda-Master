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
	'color' => TbHtml::NAVBAR_COLOR_INVERSE,
        'brandLabel' => 'Cpanel',
//        'brandUrl' => Yii::app()->request->baseUrl.'/site/index',
//        'display' => null,
        'collapse' => true,
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbNav',
                'items' => array(
                    array(
                        'label' => 'Система',
                        'url' => '#',
                        'class'=>'divider-vertical',
                        'items'=> array(
                            array('label' => 'Пользователи', 'url' => array('/users/index')),
                            array('label' => 'Настройки', 'url' => array('/config/index')),
                        )
                    ),
//                    array(
//                        'label' => 'Login',
//                        'url' => array('/site/login'),
//                        'visible' => Yii::app()->user->isGuest
//                    ),
                    array(
                        'label' => 'Разделы',
                        'url' => '#',
                        'class'=>'divider-vertical',
                        'items'=> array(
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
                    ),
                    array(
                        'label' => Yii::app()->user->name ,
                        'url' => '#',
                        'class'=>'offset6 pull-right',
                        'items'=> array(
                            array('label' => 'Учетная запись', 'url' => array('/catalog/index')),
                            array('label' => 'Выход', 'url' => array('/site/logout')),
                        )
                    ),
//                    array(
//                        'label' => 'Users list',
//                        'url' => array('/user'),
//                        'visible' => !Yii::app()->user->isGuest
//                    )
                ),
            ),
        ),
    )
);
