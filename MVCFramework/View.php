<?php
namespace MVCFramework;

class View
{
    private static $_instance = null;
    private $___viewPath = null;
    private $___viewDir = null;
    private $___data = array();
    private $___layoutParts = array();
    private $___layoutData = array();

    private function __construct(){
        $this->___viewPath = \MVCFramework\App::getInstance()->getConfig()->app['views_dir'];
        if($this->___viewPath == null){
            $this->___viewPath = realpath('../views/');
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
        $this->___data[$name] = $value;
    }

    public function __get($name){
        return $this->___data[$name];
    }

    public function setViewDirectory($path){
        $path = trim($path);
        if($path){
            $path = realpath($path) . DIRECTORY_SEPARATOR;
            if(is_dir($path) && is_readable($path)){
                $this->___viewDir = $path;
            } else {
                throw new \Exception('Invalid path for view directory.', 500);
            }
        } else {
            throw new \Exception('Invalid path for view directory.', 500);
        }
    }

    public function display($name, $data = array(), $returnAsString = false){
        if(is_array($data)){
            $this->___data = array_merge($this->___data, $data);
        }

        if(count($this->___layoutParts) > 0){
            foreach($this->___layoutParts as $key => $value){
                $part = $this->_includeFile($value);
                if($part){
                    $this->___layoutData[$key] = $part;
                }
            }
        }

        if($returnAsString){
            return $this->_includeFile($name);
        } else {
            echo $this->_includeFile($name);
        }
    }

    public function getLayoutData($name){
        return $this->___layoutData[$name];
    }

    public function appendToLayout($key, $template){
        if($key && $template){
            $this->___layoutParts[$key] = $template;
        } else {
            throw new \Exception('Layout requires valid key and template.', 500);
        }
    }

    private function _includeFile($file){
        if($this->___viewDir == null){
            $this->setViewDirectory($this->___viewPath);
        }

        $___fileName = str_replace('.', DIRECTORY_SEPARATOR, $file);
        $___filePath = $this->___viewDir . $___fileName . '.php';
        if(file_exists($___filePath) && is_readable($___filePath)){
            ob_start();
            include $___filePath;
            return ob_get_clean();
        }else{
            throw new \Exception('View ' . $file . ' can not be included.', 500);
        }
    }
}