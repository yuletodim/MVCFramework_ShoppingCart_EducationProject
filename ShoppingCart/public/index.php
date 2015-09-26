<?php
error_reporting(E_ALL ^ E_NOTICE);

include '../../MVCFramework/App.php';

$app = \MVCFramework\App::getInstance();

$config = \MVCFramework\Config::getInstance();
$config->setConfigFolder('../config');


echo $config->db['name'];
echo $config->app['test1'];

$app->run();

