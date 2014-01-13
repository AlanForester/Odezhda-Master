<?php
/**
 * Top menu definition.
 *
 * @var BackendController $this
 */

$this->widget(
    'bootstrap.widgets.TbNavbar',
    array(
        //'type' => 'inverse',
	'color' => TbHtml::NAVBAR_COLOR_INVERSE,
        'brandLabel' => 'Project name',
        'brandUrl' => '/',
        'collapse' => true,
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbNav',
                'items' => array(
                    array('label' => 'Home', 'url' => array('/site/index')),
                    array(
                        'label' => 'Login',
                        'url' => array('/site/login'),
                        'visible' => Yii::app()->user->isGuest
                    ),
                    array(
                        'label' => 'Logout (' . Yii::app()->user->name . ')',
                        'url' => array('/site/logout'),
                        'visible' => !Yii::app()->user->isGuest
                    ),
                    array(
                        'label' => 'Users list',
                        'url' => array('/user'),
                        'visible' => !Yii::app()->user->isGuest
                    )
                ),
            ),
        ),
    )
);
