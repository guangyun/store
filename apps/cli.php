<?php
$path = dirname(__FILE__).'/commands';

/**
 * Read auto-loader
 */

include  $path. '/config/loader.php';

/**
 * Read the configuration
 */
$config = include $path. '/config/config.php';

/**
 * Read the services
 */
include $path . '/config/services.php';

/**
 * Process the console arguments
 */
$arguments = array();

foreach ($argv as $k => $arg) {
    if ($k == 1) {
        $arguments['task'] = $arg;
    } elseif ($k == 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

try {

    /**
     * Handle
     */
    $console->handle($arguments);

    /**
     * If configs is set to true, then we print a new line at the end of each execution
     *
     * If we dont print a new line,
     * then the next command prompt will be placed directly on the left of the output
     * and it is less readable.
     *
     * You can disable this behaviour if the output of your application needs to don't have a new line at end
     */
    if (isset($config["printNewLine"]) && $config["printNewLine"]) {
        echo PHP_EOL;
    }

} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
//     echo implode(PHP_EOL, $e->getTrace());
    exit(255);
}
