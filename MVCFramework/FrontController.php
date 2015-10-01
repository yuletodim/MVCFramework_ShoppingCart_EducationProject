<?php
namespace MVCFramework;

class FrontController
{
    private static $_instance = null;
    private $router = null;
    private $namespace = null;
    private $controller = null;
    private $method = null;

    private function __construct(){
    }

    public function getRouter(){
        return $this->router;
    }

    public function setRouter(\MVCFramework\Routers\DefaultRouter $router){
        $this->router = $router;
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
        if($this->router == null){
            throw new \Exception('No valid router found.', 500);
        }
        
        $_uri = $this->router->getURI();
        //var_dump($_uri);
        $routes = \MVCFramework\App::getInstance()->getConfig()->routes;

        $_cacheNamespace = [];

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
          $this->controller = strtolower($_params[0]);

           if($_params[1]){
               $this->method = strtolower($_params[1]);
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
                $_cacheNamespace['controllers'][$this->controller]['to']){
            if($_cacheNamespace['controllers'][$this->controller]['methods'][$this->method]){
                $this->method = strtolower($_cacheNamespace['Controllers'][$this->controller]['methods'][$this->method]);
            }

            $this->controller = strtolower($_cacheNamespace['controllers'][$this->controller]['to']);
        }
//        echo $this->namespace .'<br>';
//        echo $this->controller .'<br>';
//        echo $this->method .'<br>';

        $fileController = $this->namespace . '\\' . ucfirst($this->controller) . 'Controller';
        $currentController = new $fileController();
//        var_dump($currentController);
        $currentController->{$this->method}();

    }

    public function getDefaultController(){
        $controller = \MVCFramework\App::getInstance()->getConfig()->app['default_controller'];
        if($controller){
            return strtolower($controller);
        }

        return 'index';
    }

    public function getDefaultMethod(){
        $method = \MVCFramework\App::getInstance()->getConfig()->app['default_method'];
        if($method){
            return strtolower($method);
        }

        return 'index';
    }
}