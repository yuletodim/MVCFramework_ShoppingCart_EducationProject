<?php
error_reporting(E_ALL ^ E_NOTICE);

include '../../MVCFramework/App.php';

$app = \MVCFramework\App::getInstance();
// default config folder: config
// set custom config folder:
// $app->setConfigFolder($path);

\MVCFramework\Loader::registerNamespace('Test\Models',
    'C:/xampp/htdocs/WebDevelopmentBasics/MVCFramework_ShoppingCart_EducationProject/trunk/ShoppingCart/Models');

// set custom router:
// $app->setRouter('RPCRouter');


$app->run();
var_dump($app->getConnection('default'));



new Test\Models\User();
$n = \MVCFramework\Loader::getNamespaces();
echo '<br>';
foreach($n as $k => $v){
    echo $k.'=>'.$v .'<br>';
}

//var_dump($app->getConfig()->routes);








