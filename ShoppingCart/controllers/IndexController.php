<?php
namespace Controllers;

class IndexController{
    public function index(){
        echo "bravo be";
        $view = \MVCFramework\View::getInstance();

        // kluchovete sami si gi zadavame -> body, body2 i t.n.
        $view->appendToLayout('body', 'index');
        $view->appendToLayout('body2', 'admin.index');
        $view->display('layouts.default');
        // blagodar na magic __set =>
        // $view->username = 'gataka';
        // $view->display('index', array("arr"=>array(1, 2, 3)));
        //$view->display('admin.index');

        // if returnAsString is set true
//        $a = $view->display('index', array("arr"=>array(1, 2, 3)), true);
//        var_dump($a);


    }
}