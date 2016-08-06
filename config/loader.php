<?php
$loader = new \Phalcon\Loader();

$loader->registerNamespaces(array(
    'Store\Extensions'=>APP_PATH.'/extensions/',
    'Store\Components'=>APP_PATH.'/apps/components/',
));
$loader->registerDirs(array(
    APP_PATH.'/apps/models/',
));
$loader->register();