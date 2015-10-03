<?php
namespace MVCFramework\Routers;

class DefaultRouter implements \MVCFramework\Routers\IRouter
{
    public function getURI(){
        $nameLength = strlen($_SERVER['SCRIPT_NAME']) + 1;
        $uri = substr($_SERVER['PHP_SELF'], $nameLength);

        return $uri;
    }

    public function getPost(){
        return $_POST;
    }
}