<?php
namespace MVCFramework;

class View
{
    private static $_instance = null;
    private $viewPath = null;
    private $viewDir = null;
    private $data = array();

    private function __construct(){
        $this->viewPath = \MVCFramework\App::getInstance()->getConfig()->app['views_dir'];
        if($this->viewPath == null){
            $this->viewPath = realpath('../views/');
        }
    }

    /**
     * @return \MVCFramework\View
     */
    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new \MVCFramework\View();
        }

        return self::$_instance;
    }

    public function __set($name, $value){
        $this->data[$name] = $value;
    }

    public function __get($name){
        return $this->data[$name];
    }

    public function setViewDirectory($path){
        $path = trim($path);
        if($path){
            $path = realpath($path) . DIRECTORY_SEPARATOR;
            if(is_dir($path) && is_readable($path)){
                $this->viewDir = $path;
            } else {
                throw new \Exception('Invalid path for view directory.', 500);
            }
        } else {
            throw new \Exception('Invalid path for view directory.', 500);
        }
    }

    public function display($name, $data = array(), $returnAsString = false){
        if(is_array($data)){
            $this->data = array_merge($this->data, $data);
        }

        if($returnAsString){
            return $this->_includeFile($name);
        } else {
            echo $this->_includeFile($name);
        }
    }

    private function _includeFile($file){
        if($this->viewDir == null){
            $this->setViewDirectory($this->viewPath);
        }

        $fileName = str_replace('.', DIRECTORY_SEPARATOR, $file);
        $filePath = $this->viewDir . $fileName . '.php';
        if(file_exists($filePath) && is_readable($filePath)){
            ob_start();
            include $filePath;
            return ob_get_clean();
        }else{
            throw new \Exception('View ' . $file . 'can not be included.', 500);
        }
    }
}