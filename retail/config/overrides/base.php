<?php

/**
 * Base overrides for frontend application
 */
return [
    // So our relative path aliases will resolve against the `/frontend` subdirectory and not nonexistent `/protected`
    'basePath' => 'retail',
    'import' => [
        'application.components.*',
        'application.controllers.*',
        'application.controllers.actions.*',
        'common.actions.*',
    ],
    'controllerMap' => [
        // Overriding the controller ID so we have prettier URLs without meddling with URL rules
        'site' => 'RetailSiteController'
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

                        // Modal
                        'js/modal/jquery.arcticmodal-0.3.min.js',
                    ],
                    'css' => [
                        'css/reset.css',
                        'css/flick/jquery-ui-1.10.3.custom.css',
                        'css/style.css',

                        // Slider
                        'js/slider/captions.css',
                        'js/slider/settings.css',
                        'js/slider/style.css',

                        // Modal
                        'js/modal/jquery.arcticmodal-0.3.css',
                        'js/modal/themes/simple.css',
                    ],
                    'depends' => ['jquery', 'jquery.ui']
                ],
                'index' => [
                    'baseUrl' => '/',
                    'css' => [
                        'css/main.css',
                    ],
                    'depends' => ['core'],
                ],
                'catalog' => [
                    'baseUrl' => '/',
                    'js' => [

                    ],
                    'css' => [
                        'css/catalog.css',
                    ],
                    'depends' => ['core']
                ],
                'product' => [
                    'baseUrl' => '/',
                    'js' => [
                        'js/karta-slider/jquery.jqzoom-core-pack.js',
                    ],
                    'css' => [
                        'css/karta.css',
                        'js/karta-slider/jquery.jqzoom.css',
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