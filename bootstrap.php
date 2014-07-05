<?php  
function pr($thing = '') {
    echo '<pre>';
    print_r($thing);
    echo '</pre>';
}

include_once('./models/Autoloader.php');
require_once('./vendor/autoload.php');
spl_autoload_register(array(new \IMDBParser\Models\AutoLoader(), 'load'));

include_once('./config.php');
date_default_timezone_set('America/New_York');

$connFactory = new \Illuminate\Database\Connectors\ConnectionFactory(new \Illuminate\Container\Container());
$conn = $connFactory->make($config['db']);
$resolver = new \Illuminate\Database\ConnectionResolver();
$resolver->addConnection('default', $conn);
$resolver->setDefaultConnection('default');
\Illuminate\Database\Eloquent\Model::setConnectionResolver($resolver);


$logger = new \IMDBParser\Models\Logger(fopen($config['log.file'], 'a+'));