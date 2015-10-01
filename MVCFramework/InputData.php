<?php
namespace MVCFramework;

class InputData
{
    private static $_instance = null;
    private $_get = array();
    private $_post = array();
    private $_cookies = array();

    private function __construct(){
        $this->_cookies = $_COOKIE;
    }

    public function setGet($getInput){
        if(is_array($getInput)){
            $this->_get = $getInput;
        }
    }

    public function setPost($postInput){
        if(is_array($postInput)){
            $this->_post = $postInput;
        }
    }

    public function hasGetValue($position){
        return array_key_exists($position, $this->_get);
    }

    public function hasPostValue($name){
        return array_key_exists($name, $this->_post);
    }

    public function hasCookiesValue($name){
        return array_key_exists($name, $this->_cookies);
    }

    public function takeGet($position, $normalize = null, $defaultValue = null){
        if($this->hasGetValue($position)){
            if($normalize != null){
                return \MVCFramework\Utilities::normalize($this->_get[$position], $normalize);
            }

            return $this->_get[$position];
        }

        return $defaultValue;
    }

    public function takePost($name, $normalize = null, $defaultValue = null){
        if($this->hasPostValue($name)){
            if($normalize != null){
                return \MVCFramework\Utilities::normalize($this->_post[$name], $normalize);
            }

            return $this->_post[$name];
        }

        return $defaultValue;
    }

    public function takeCookies($name, $normalize = null, $defaultValue = null){
        if($this->hasCookiesValue($name)){
            if($normalize != null){
                return \MVCFramework\Utilities::normalize($this->_cookies[$name], $normalize);
            }

            return $this->_cookies[$name];
        }

        return $defaultValue;
    }

    /**
     * @return \MVCFramework\InputData
     */
    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new \MVCFramework\InputData();
        }

        return self::$_instance;
    }
}