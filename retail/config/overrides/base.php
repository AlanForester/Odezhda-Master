<?php

/**
 * Base overrides for frontend application
 */
return [
    'params'=>[
        'title'=>'Лапана',
        'staticUrl'=>'http://old.om.codetek.ru/',
        'contactEmail'=>'info@lapana.ru',
        'contactTel'=>'222-962, +7 (4932) 343-588',
        'contactAddress'=>'г. Иваново, Проспект Ленина д.98',
//        'staticUrl'=>'http://odezhda-master.ru/'
        'markup'=>10,
        'frontPageSize'=>12,
        'socialPageSize'=>6
        //наценка
    ],
    // So our relative path aliases will resolve against the `/frontend` subdirectory and not nonexistent `/protected`
    'basePath' => 'retail',
    'import' => [
        'application.components.*',
        'application.controllers.*',
        'application.controllers.actions.*',
        'common.components.*',
        'common.actions.*',
        'common.models.AR.*',
        'common.models.layers.*',
        'common.models.legacy.*',

        'common.helpers.*',
        'common.models.*',

        'retail.models.*',
        'bootstrap.helpers.*',
    ],
    'controllerMap' => [
        // Overriding the controller ID so we have prettier URLs without meddling with URL rules
        'site' => 'RetailSiteController',
        'info' => 'InfoPagesController',
        'cart' => 'CartController',
        'social' => 'SocialController'
    ],
    'components' => [
        'session'=>[
                'autoStart' => true,
                'timeout' => 60,
                'cookieMode' =>'only',
                'cookieParams' => array('secure' => false, 'httponly' => false),

        ],
        'errorHandler' => [
            // Installing our own error page.
            'errorAction' => 'site/error'
        ],
        'clientScript' => [
            'scriptMap' => [
                'bootstrap-responsive.css' => false,
                'yiistrap.css' => false,
                'bootstrap.css' => false,
                'bootstrap.min.js' => false,
                'bootstrap-yii.css' => false,
            ],
            'packages' => [

                'coreSocial' => [
                    'baseUrl' => '/',
                    'js' => [
                        //Slider
                        'js/slider/jquery.themepunch.plugins.min.js',
                        'js/slider/jquery.themepunch.revolution.min.js',
                        'js/slider-clothes/jquery.jcarousel.min.js',
                        'js/slider-clothes/jcarousel.responsive.js',
                        //bottom-panel
                        'js/social-panel/jquery.jqEasyPanel.min.js',
                        'js/social-panel/easypaginate.js',

                        //lightbox
                        'js/jquery.easing.1.3.js',
                        'js/lightbox/jquery.lightbox.js',

                        'js/karta-slider/jquery.jqzoom-core-pack.js',
                        'js/main.js'
                    ],
                    'css' => [
                        'css/reset.css',
                        'css/flick/jquery-ui-1.10.3.custom.css',
                        'css/style.css',

                        //bottom-panel
                        'js/social-panel/jqeasypanel.css',

                        // Slider
                        'js/slider/captions.css',
                        'js/slider/settings.css',
                        'js/slider/style.css',
                        //lightbox
                        'js/lightbox/jquery.lightbox.css',

                        // Modal
                        'js/modal/themes/simple.css',

                        'js/karta-slider/jquery.jqzoom.css',
                    ],
                    'depends' => ['jquery', 'jquery.ui']
                ],

                'core' => [
                    'baseUrl' => '/',
                    'js' => [
                        //Slider
                        'js/slider/jquery.themepunch.plugins.min.js',
                        'js/slider/jquery.themepunch.revolution.min.js',
                        'js/slider-clothes/jquery.jcarousel.min.js',
                        'js/slider-clothes/jcarousel.responsive.js',
                        //bottom-panel
                        'js/bottom-panel/jquery.jqEasyPanel.min.js',
                        'js/bottom-panel/easypaginate.js',

                        //lightbox
                        'js/jquery.easing.1.3.js',
                        'js/lightbox/jquery.lightbox.js',

                        // Modal
                        // todo: удалить
                        //'js/modal/jquery.arcticmodal-0.3.min.js',

                        'js/karta-slider/jquery.jqzoom-core-pack.js',
                        'js/main.js'
                    ],
                    'css' => [
                        'css/reset.css',
                        'css/flick/jquery-ui-1.10.3.custom.css',
                        'css/style.css',

                        //bottom-panel
                        'js/bottom-panel/jqeasypanel.css',

                        // Slider
                        'js/slider/captions.css',
                        'js/slider/settings.css',
                        'js/slider/style.css',
                        //lightbox
                        'js/lightbox/jquery.lightbox.css',

                        // Modal
                        // todo: удалить
                        //'js/modal/jquery.arcticmodal-0.3.css',
                        'js/modal/themes/simple.css',

                        'js/karta-slider/jquery.jqzoom.css',
                    ],
                    'depends' => ['jquery', 'jquery.ui']
                ],
                'index' => [
                    'baseUrl' => '/',
                    'js' => [
                        'js/index.js',
                    ],
                    'css' => [
                        'css/main.css',
                        'js/slider-clothes/jcarousel.responsive.css',
                    ],
                    'depends' => ['core'],
                ],
                'catalog' => [
                    'baseUrl' => '/',
                    'js' => [
                        'js/tabs/withoutPlugin.js',
                        'js/tabs/organictabs.jquery.js',
                        'js/catalog.js',
                    ],
                    'css' => [
                        'css/catalog.css',
                        'css/karta.css',
                        'js/slider-clothes/jcarousel.responsive.css',
                        'js/tabs/style.css',
                    ],
                    'depends' => ['core']
                ],
                'product' => [
                    'baseUrl' => '/',
                    'js' => [
                        'js/product.js',
                    ],
                    'css' => [
                        'css/karta.css',
                        'js/slider-clothes/jcarousel.responsive-karta.css',
                    ],
                    'depends' => ['core']
                ],
                'social' => [
                    'baseUrl' => '/',
                    'depends' => ['coreSocial'],
                    'js' => [

                    ],
                    'css' => [
                        'css/karta.css',
                        'js/slider-clothes/jcarousel.responsive.css',
                        'js/tabs/style.css',
                        'css/social.css',
                    ],

                ],
            ]
        ],
        'urlManager' => [
            // Some sane usability rules
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            // Your other rules here...
            ]
        ],
    ],
];