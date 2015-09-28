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
        $a = new\MVCFramework\Routers\DefaultRouter();
        $a->parse();
    }
}