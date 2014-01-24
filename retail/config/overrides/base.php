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
        'clientScript' => array(
            'scriptMap' => array(
                'bootstrap-responsive.css' => false,
                'yiistrap.css' => false,
                'bootstrap.css' => false,
                'bootstrap.min.js' => false,
                'bootstrap-yii.css' => false,
                'jquery.js' => false,
            )
        ),
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