<?php

/**
 * Register application modules
 */
$application->registerModules(array(
    'frontend' => array(
        'className' => 'Store\Frontend\Module',
        'path' => __DIR__ . '/../apps/frontend/Module.php'
    ),
	'backend' => array(
        'className' => 'Store\Backend\Module',
        'path' => __DIR__ . '/../apps/backend/Module.php'
    )
));
