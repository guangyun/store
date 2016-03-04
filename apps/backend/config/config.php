<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'  => 'Mysql',
        'host'     => '192.168.11.102',
        'username' => 'root',
        'password' => 'root',
        'dbname'   => 'phalcon',
        'charset'  => 'utf8',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../controllers/',
        'modelsDir'      => __DIR__ . '/../models/',
        'migrationsDir'  => __DIR__ . '/../migrations/',
        'viewsDir'       => __DIR__ . '/../views/',
        'plugnsDir'      => APP_PATH .'/apps/plugns',
        'baseUri'        => '/store/'
    )
));
