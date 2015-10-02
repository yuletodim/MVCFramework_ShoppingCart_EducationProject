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
    private $_dbConnections = array();
    private $_session = null;

    private function __construct(){
        \MVCFramework\Loader::registerNamespace('MVCFramework', dirname(__FILE__).DIRECTORY_SEPARATOR);
        \MVCFramework\Loader::registerAutoLoad();
        $this->_config = \MVCFramework\Config::getInstance();
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

    public function getRouter()
    {
        return $this->router;
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }

    /**
     * @return \MVCFramework\Sessions\ISession
     */
    public function getSession(){
        return $this->_session;
    }
    // option to set custom session
    public function setSession(\MVCFramework\Sessions\ISession $session){
        $this->_session = $session;
    }

    public function run(){
        // if config folder is not set use default one
        if($this->_config->getConfigFolder() == null){
            $this->setConfigFolder('../config');
        }

        $_sess = $this->_config->app['session'];
        if($_sess['autostart']){
            if($_sess['type'] == 'native'){
                $_session = new \MVCFramework\Sessions\NativeSession(
                    $_sess['name'],
                    $_sess['lifetime'],
                    $_sess['path'],
                    $_sess['domain'],
                    $_sess['secure']
                );

                $this->setSession($_session);
            }
            else if($_sess['type'] == 'database'){
                $_session = new \MVCFramework\Sessions\DBSession(
                    $_sess['db_connection'],
                    $_sess['name'],
                    $_sess['db_table'],
                    $_sess['lifetime'],
                    $_sess['path'],
                    $_sess['domain'],
                    $_sess['secure']
                );

                $this->setSession($_session);
            } else {
                throw new \Exception('No valid session.', 500);
            }
        }

        $this->_frontController = \MVCFramework\FrontController::getInstance();

        if($this->router instanceof \MVCFramework\Routers\IRouter){
            $this->_frontController->setRouter($this->router);
        } else if($this->router == 'JsonRPCRouter'){
            // TODO: implement JsonRPCRouter
        } else if($this->router == 'CLIRouter'){
            // TODO: implement CLIRouter
        } else {
            $this->_frontController->setRouter(new \MVCFramework\Routers\DefaultRouter());
        }

        $this->_frontController->dispatch();
    }

    public function getDBConnection($connection = 'default'){
        if(!$connection){
            throw new \Exception('No valid connection provider.', 500);
        }

        if($this->_dbConnections[$connection]){
            return $this->_dbConnections[$connection];
        }

        $config = $this->getConfig()->database;
        if(!$config[$connection]){
            throw new \Exception('No valid connection provider.', 500);
        }

        $dsn = $config[$connection]['connection_url'];
        $user = $config[$connection]['username'];
        $pass = $config[$connection]['password'];
        $options = $config[$connection]['pdo_options'];

        $pdo = new \PDO($dsn, $user, $pass, $options);
        $this->_dbConnections[$connection] = $pdo;

        return $this->_dbConnections[$connection];
    }

    public function __destruct(){
        if($this->_session != null){
            $this->_session->saveSession();
        }
    }
}