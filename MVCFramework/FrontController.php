<?php
namespace MVCFramework;

class FrontController
{
    private static $_instance = null;

    private function __construct(){

    }

    /**
     * @return \MVCFramework\FrontController
     */
    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new \MVCFramework\FrontController();
        }

        return self::$_instance;
    }

    public function dispatch(){
        $router = new\MVCFramework\Routers\DefaultRouter();
        $router->parse();

        $controller = $router->getController();
        if($controller == null){
            $controller = $this->getDefaultController();
        }

        $method = $router->getMethod();
        if($method == null){
            $method = $this->getDefaultMethod();
        }
        echo $controller . '<br>'. $method;
    }

    public function getDefaultController(){
        $controller = \MVCFramework\App::getInstance()->getConfig()->app['default_controller'];
        if($controller){
            return $controller;
        }

        return 'Index';
    }

    public function getDefaultMethod(){
        $method = \MVCFramework\App::getInstance()->getConfig()->app['default_method'];
        if($method){
            return $method;
        }

        return 'index';
    }
}