<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 24.09.2015
 * Time: 17:26
 */

namespace MVCFramework;


final class Loader
{
    private static $namespaces = array();

    private function __construct(){

    }

    public static function registerAutoLoad(){
        spl_autoload_register(array("\MVCFramework\Loader", 'autoload'));
    }

    public static function autoload($class){
        self::loadClass($class);
    }

    public static function loadClass($class){
        foreach(self::$namespaces as $key => $value){
            if(strpos($class, $key) === 0){
                //echo $key.'<br>'.$value.'<br>'.$class.'<br>';
                $file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
                $file = substr_replace($file, $value, 0, strlen($key)) . '.php';
                $file = realpath($file);
                if($file && is_readable($file)){
                    include $file;
                }else{
                    // TODO
                    // throw new \Exception("Can not find file: " . $file);
                }
            }
            break;
        }
    }

    public static function registerNamespace($namespace, $path){
        $namespace = trim($namespace);
        if(strlen($namespace) > 0){
            if(!$path){
                throw new \Exception('Invalid path.');
            }
            $_path = realpath($path);
            if($_path && is_dir($_path) && is_readable($_path)){
                self::$namespaces[$namespace.'\\'] = $_path.DIRECTORY_SEPARATOR;
            }else{
                // TODO
                throw new \Exception('Namespace directory read error: ' . $path);
            }
        }else{
            // TODO -> centarlizirano prihvashtane na errors
            throw new \Exception('Invalid namespace: ' . $namespace);
        }
    }

    public static function getNamespaces(){
        return self::$namespaces;
    }
}