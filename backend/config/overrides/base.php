<?php
/**
 * Base config overrides for backend application
 */
return [
//    'name'=>'Cpanel',
    'defaultController'=>'site',
    // So our relative path aliases will resolve against the `/backend` subdirectory and not nonexistent `/protected`
    'basePath' => 'backend',
    'import' => [
	    'application.components.*',
        'application.controllers.*',
        'application.controllers.actions.*',

        'common.actions.*',
        'common.models.*',
        'common.models.legacy.*',
        'common.models.layers.*',

        'application.models.*',
        'common.helpers.*',

        //'application.models.legacy.*',
    ],
//    'aliases' => array(
//        'backend.bootstrap' => realpath(__DIR__ .'/../../lib/vendor/2amigos/yiistrap')
//    ),
    'controllerMap' => [
        // Overriding the controller ID so we have prettier URLs without meddling with URL rules
        'site' => 'BackendSiteController',
        'users' => 'UsersController',
        'groups' => 'GroupsController',
    ],
    'components' => [
        // Backend uses the YiiBooster package for its UI
        'errorHandler' => array(
            // Installing our own error page.
            'errorAction' => 'site/error'
        ),
        'authManager'=>array(
            //'class'=>'CDbAuthManager' //old login type
            // New login form
            'class' => 'PhpAuthManager',
            // Default role.
            'defaultRoles' => array('guest'),
        ),
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'class'=>'WebAdmin', //added
	),
        'urlManager' => [

            // Some sane usability rules
            'rules' => [
                //'<action:\w+>' => 'site/<action>',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

                // Your other rules here...
            ]
        ],
    ],
];
