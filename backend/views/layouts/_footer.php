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
//        'color' => TbHtml::NAVBAR_COLOR_INVERSE,
        'brandLabel' => '',
        //        'brandUrl' => Yii::app()->request->baseUrl.'/site/index',
        'display' => TbHtml::NAVBAR_DISPLAY_FIXEDBOTTOM,
        'fluid' => true,
        'collapse' => true,
        'items' => [
            [

                'class' => 'bootstrap.widgets.TbNav',
                'items' => [
                    [
                        'label' => 'Статусная информация',
//                        'url' => '#',
//                        'disabled'=>true
                    ],

                ],
            ],

        ],
    ]
);
