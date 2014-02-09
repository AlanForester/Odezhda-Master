<?php

/**
 * Base overrides for frontend application
 */
return [
    'params'=>[
        'title'=>'Лапана'
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
    ],
    'components' => [
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
                'core' => [
                    'baseUrl' => '/',
                    'js' => [
                        //Slider
                        'js/slider/jquery.themepunch.plugins.min.js',
                        'js/slider/jquery.themepunch.revolution.min.js',
                        'js/slider-clothes/jquery.jcarousel.min.js',
                        'js/slider-clothes/jcarousel.responsive.js',
                        //lightbox
                        'js/lightbox/jquery.lightbox.min.js',

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