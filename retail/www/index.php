<?php
/**
 * Entry point for the frontend.
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * @author: mark safronov <hijarian@gmail.com>
 */

# Loading project default init code for all entry points.
require __DIR__.'/../../common/bootstrap.php';

# Setting up the frontend-specific aliases
Yii::setPathOfAlias('retail', ROOT_DIR .'/retail');
Yii::setPathOfAlias('www', ROOT_DIR . '/retail/www');

# We use our custom-made WebApplication component as base class for frontend app.
require_once ROOT_DIR.'/retail/components/RetailWebApplication.php';

# For obvious reasons, backend entry point is constructed of specialised WebApplication and config
Yii::createApplication(
	'RetailWebApplication', 
	ROOT_DIR.'/retail/config/main.php' 
)->run(); 
