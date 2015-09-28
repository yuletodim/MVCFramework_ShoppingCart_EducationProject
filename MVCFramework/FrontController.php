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
        var_dump($_uri);
        $routes = \MVCFramework\App::getInstance()->getConfig()->routes;

        if(is_array($routes) && count($routes) > 0){
            foreach($routes as $key => $value){
                if(stripos($_uri, $key) === 0
                    && ($_uri == $key || stripos($_uri, $key.'/') === 0)
                    && $value['namespace']){
                    $this->namespace = $value['namespace'];
                    $_uri = substr($_uri, strlen($key)+1);
                    $_cacheNamespace = $value;
                    break;
                }
            }
        }else{
            throw new \Exception('Default route is missing.', 500);
        }

        if($this->namespace == null && $routes['*']['namespace']){
            $this->namespace = $routes['*']['namespace'];
            $_cacheNamespace = $routes['*'];
        }else if($this->namespace == null && !$routes['*']['namespace']){
            throw new \Exception('Default route is missing.', 500);
        }

        $_params = explode('/', $_uri);

        if($_params[0]){
          $this->controller = $_params[0];

           if($_params[1]){
               $this->method = $_params[1];
           }else{
               $this->method = $this->getDefaultMethod();
           }
        }else{
            $this->controller = $this->getDefaultController();
            $this->method = $this->getDefaultMethod();
        }

        // check if the controller has different name than the file
        if(is_array($_cacheNamespace) &&
            $_cacheNamespace['controllers'] &&
            $_cacheNamespace['controllers'][$this->controller]){
            $this->controller = $_cacheNamespace['controllers'][$this->controller];
        }
        echo $this->controller;
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