<?php

/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 24.09.2015
 * Time: 16:16
 */
namespace MVCFramework;

include_once'Loader.php';


class App
{
    private static $_instance = null;

    /**
     * @var \MVCFramework\Config
     */
    private $_config = null;

    /**
     * @var \MVCFramework\FrontController
     */
    private $_frontController = null;
    private $router;

    private function __construct(){
        \MVCFramework\Loader::registerNamespace('MVCFramework', dirname(__FILE__).DIRECTORY_SEPARATOR);
        \MVCFramework\Loader::registerAutoLoad();
        $this->_config = \MVCFramework\Config::getInstance();
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }

    /**
     * @return \MVCFramework\App
     */
    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new \MVCFramework\App();
        }

        return self::$_instance;
    }

    public function run(){
        // if config folder is not set use default one
        if($this->_config->getConfigFolder() == null){
            $this->setConfigFolder('../config');
        }

        $this->_frontController = \MVCFramework\FrontController::getInstance();

        if($this->router instanceof \MVCFramework\Routers\IRouter){
            $this->_frontController->setRouter($this->router);
        } else if($this->router == 'JsonRPCRouter'){
            // TODO: implement JsonRPCRouter
        } else if($this->router == 'CLIRouter'){
            // TODO: implement JsonRPCRouter
        } else {
            $this->_frontController->setRouter(new \MVCFramework\Routers\DefaultRouter());
        }
        $this->_frontController->dispatch();
    }

    /**
     * @return \MVCFramework\Config
     */
    public function getConfig(){
        return $this->_config;
    }

    public function setConfigFolder($path){
        $this->_config->setConfigFolder($path);
    }

    public function getConfigFolder(){
        return $this->_configFolder;
    }
}