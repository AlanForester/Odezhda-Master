<?php
/**
 * Configuration parameters common to all entry points.
 */
return [
    'components' => [
        'db' => [
            'connectionString' => 'mysql:host=localhost;dbname=codetek3',
            'username' => 'root',
            'password' => '987975',
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'charset' => 'utf8',
        ],
        'session' => [
            'class' => 'system.web.CHttpSession',
            'sessionName' => 'SID',
            'timeout' => 1228800,
            'cookieParams' =>  [
                'lifetime' => 31536000,
                'path' => '/'
            ]
        ],
    ]

];
