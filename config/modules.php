<?php

/**
 * Register application modules
 */
$application->registerModules(array(
	'backend' => array(
        'className' => 'Store\Backend\Module',
        'path' => __DIR__ . '/../apps/backend/Module.php'
    ),
    'qttown' => array(
        'className' => 'Store\Qttown\Module',
        'path' => __DIR__ . '/../apps/qttown/Module.php'
    )
));
