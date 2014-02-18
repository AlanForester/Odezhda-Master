<?php
/**
 * Configuration parameters common to all entry points.
 */
return [
    'preload' => ['log','bootstrap'],
    'import' => [
        'common.components.*',
        'common.models.*',
        'common.helpers.*',
        // The following two imports are polymorphic and will resolve against wherever the `basePath` is pointing to.
        // We have components and models in all entry points anyway
        'application.components.*',
        'application.models.*',
        'extensions.mail.YiiMailMessage',
        'bootstrap.helpers.TbHtml'
    ],
    'aliases' => [
        'bootstrap' => realpath(__DIR__ .'/../../lib/vendor/2amigos/yiistrap'), // change this if necessary
        'yiiwheels' => realpath(__DIR__ .'/../../lib/vendor/2amigos/yiiwheels'),
    ],
//    'import' => [
//        'bootstrap.helpers.TbHtml',
//    ],
    'components' => [ 
        'bootstrap' => [
            'class' => 'bootstrap.components.TbApi',   
        ],
         'yiiwheels' => [
            'class' => 'yiiwheels.YiiWheels',   
        ],

        'mail' => [
 			'class' => 'ext.yii-mail.YiiMail',
 			'transportType' => 'php',
 			'viewPath' => 'application.views.mail',
 			'logging' => true,
 			'dryRun' => false
 		],

        // http://www.yiiframework.com/extension/email/
//        'email'=> [
//            'class'=>'application.extensions.email.Email',
//            'delivery'=>'php',
//        ],

        'db' => [ 
			'connectionString' => 'mysql:host=localhost;dbname=om',
			'username' => 'om',
			'password' => '842655',
			'enableProfiling' => true,
			'enableParamLogging' => true,
			'charset' => 'utf8',
		],
        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '/',
        ],
        'cache' => extension_loaded('apc')
                ? [
                    'class' => 'CApcCache',
                ]
                : [
                    'class' => 'CDbCache',
                    'connectionID' => 'db',
                    'autoCreateCacheTable' => true,
                    'cacheTableName' => 'cache',
                ],
        'messages' => [
            'basePath' => 'common.messages'
        ],
        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                'logFile' => [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                    'filter' => 'CLogFilter'
                ],
            ]
        ],
    ]
];
