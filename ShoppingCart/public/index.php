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

//$app->getSession()->counter+=1;
//echo $app->getSession()->counter;
//
//var_dump($app->getDBConnection('default'));
//$db = new \MVCFramework\DB\SimpleDB();
//$a = $db->prepare('SELECT * FROM users');
//$a->execute();
//print_r($a->fetchAllAssoc());
//$b = $db->prepare("SELECT * FROM users WHERE id = ?");
//$b->execute([1]);
//print_r($b->fetchRowAssoc());
//
//
// new Test\Models\User();
//$n = \MVCFramework\Loader::getNamespaces();
//echo '<br>';
//foreach($n as $k => $v){
//    echo $k.'=>'.$v .'<br>';
//}
//
//var_dump($app->getConfig()->routes);








