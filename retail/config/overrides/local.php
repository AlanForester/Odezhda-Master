<?php
/**
 * Configuration parameters common to all entry points.
 */
return [
    'components' => [
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
