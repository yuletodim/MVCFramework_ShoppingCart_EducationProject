<?php
error_reporting(E_ALL ^ E_NOTICE);

include '../../MVCFramework/App.php';

$app = \MVCFramework\App::getInstance();

$app->run();

var_dump($app->getConfig()->app);

// default config folder: config
// in case developer wants another use:
// $app->setConfigFolder($path);

// echo $config->app['test1'];



