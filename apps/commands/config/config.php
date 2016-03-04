<?php
return new \Phalcon\Config(array(
    'version' => '1.0',
    'printNewLine' => true,
    'database' => array(
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'dbname' => 'phalcon',
        'charset' => 'utf8'
    )
));