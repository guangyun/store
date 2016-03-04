<?php
$loader = new \Phalcon\Loader();
$loader->registerDirs(
    array(
        $path.'/tasks/'
    )
);
$loader->register();