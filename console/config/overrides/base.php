<?php
/**
 * Overrides for configuration when we're in console application, i. e., in context of `yiic`.
 */
return [
    // Changing `application` path alias to point at `/console` subdirectory
    'basePath' => 'console',
    'import' => [
        'common.components.*',
        //'common.actions.*',
        'common.models.*',
        'common.models.legacy.*',
        'common.models.layers.*',
        'common.models.AR.*',
        'common.helpers.*',
    ],
    'commandMap' => [
        'migrate' => [
            'class' => 'system.cli.commands.MigrateCommand',
            'migrationPath' => 'application.migrations',
            'templateFile' => 'application.migrations.template.template'
        ]
    ],
];