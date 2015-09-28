<?php
namespace MVCFramework;

class FrontController
{
    private static $_instance = null;
    private $namespace = null;
    private $controller = null;
    private $method = null;

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
        $_uri = $router->getURI();

        $routes = \MVCFramework\App::getInstance()->getConfig()->routes;

        if(is_array($routes) && count($routes) > 0){
            foreach($routes as $key => $value){
                if(stripos($_uri, $key) === 0 && $value['namespace']){
                    $this->namespace = $value['namespace'];
                    break;
                }
            }
        }else{
            throw new \Exception('Default route is missing.', 500);
        }

        if($this->namespace == null && $routes['*']['namespace']){
            $this->namespace = $routes['*']['namespace'];
        }else if($this->namespace == null && !$routes['*']['namespace']){
            throw new \Exception('Default route is missing.', 500);
        }

        echo $this->namespace;
//        $router->parse();
//
//        $controller = $router->getController();
//        if($controller == null){
//            $controller = $this->getDefaultController();
//        }
//
//        $method = $router->getMethod();
//        if($method == null){
//            $method = $this->getDefaultMethod();
//        }
//        echo $controller . '<br>'. $method;
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