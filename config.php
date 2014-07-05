<?php
$config = array(
    'db' => array(
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'database' => 'imdb',
        'username' => 'username',
        'password' => 'password',
        'collation' => 'utf8_general_ci',
        'charset' => 'utf8',
        'prefix' => 'imdb_',
        'port' => ''
    ),
    'log.file' => './logs/Log.txt'
);


if (file_exists('./devConfig.php')) {
    include_once('./devConfig.php');
}