<?php
/**
 * Base config overrides for backend application
 */
return [
    //    'name'=>'Cpanel',
    'defaultController' => 'site',
    // So our relative path aliases will resolve against the `/backend` subdirectory and not nonexistent `/protected`
    'basePath' => 'backend',
    'import' => [
        'application.components.*',
        'application.controllers.*',
        'application.controllers.actions.*',
        'application.models.*',
        'application.helpers.*',

        'common.components.*',
        'common.actions.*',
        'common.models.*',
        'common.models.legacy.*',
        'common.models.layers.*',
        'common.models.AR.*',
        'common.helpers.*',

        'bootstrap.helpers.*',
        'common.extensions.upload.*'
//        'common.helpers.*',
    ],
    //    'aliases' => array(
    //        'backend.bootstrap' => realpath(__DIR__ .'/../../lib/vendor/2amigos/yiistrap')
    //    ),
    'controllerMap' => [
        // Overriding the controller ID so we have prettier URLs without meddling with URL rules
        'site' => 'BackendSiteController',
        'users' => 'UsersController',
        'groups' => 'GroupsController',
        'categories' => 'ShopCategoriesController',
        'info_pages' => 'InfoPagesController',
        'order' => 'OrdersController',
        'retail_delivery' => 'RetailDeliveryController',
        'retail_orders' => 'RetailOrdersController',
        'retail_orders_products' => 'RetailOrdersProductsController',
        'retail_banners' => 'RetailBannersController',
    ],
    'components' => [
        // Backend uses the YiiBooster package for its UI
        'errorHandler' => [
            // Installing our own error page.
            'errorAction' => 'site/error'
        ],
        'authManager' => [
            //'class'=>'CDbAuthManager' //old login type
            // New login form
            'class' => 'PhpAuthManager',
            // Default role.
            'defaultRoles' => ['guest'],
        ],
        'user' => [
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebAdmin', //added
        ],
        'urlManager' => [
            'rules' => [
                //'<action:\w+>' => 'site/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                'retail_orders_products/<action:\w+>/<id:\-?\d+>' => 'retail_orders_products/<action>',
            ]
        ],
    ],
];
