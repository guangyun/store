<?php

use Phalcon\Mvc\Application;

error_reporting(E_ALL);

defined('APP_PATH') || define('APP_PATH', realpath('..'));

try {

    /**
     * Read the configuration
     */
    $config = include APP_PATH . "/apps/qttown/config/config.php";

    /**
     * Include services
     */
    require __DIR__ . '/../config/services.php';

    /**
     * Handle the request
     */
    $application = new Application($di);

    /**
     * Include modules
     */
    require __DIR__ . '/../config/modules.php';

    /**
     * Include routes
     */
    require __DIR__ . '/../config/routes.php';
    
    /**
     * include loader
     */
    require __DIR__ . '/../config/loader.php';

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
    /* $logger = new Phalcon\Logger\Adapter\File(APP_PATH.'/runtime/logs/applicaton.log');
    $logger->log($e->getMessage());
    $logger->log($e->getTraceAsString()); */
}
