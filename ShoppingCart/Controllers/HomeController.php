<?php
namespace Controllers;

class HomeController extends \MVCFramework\BaseController
{
    public function home(){
        $this->view->appendToLayout('body', 'home');
        $this->view->display('layouts.default');

//        $val = new \MVCFramework\Validator();
//        $val->setRule('url', 'http://softuni.bg')->setRule('minLength', 'http://softuni.bg', 50);
//        $val->validate();
//        print_r($val->getErrors());

//        $input = \MVCFramework\InputData::getInstance();
//        $input->getPost(0, 'int');
//
//
//        // kluchovete sami si gi zadavame -> body, body2 i t.n.


//        // blagodar na magic __set =>

        // $view->display('index', array("arr"=>array(1, 2, 3)));
        //$view->display('user.index');

        // if returnAsString is set true
//        $a = $view->display('index', array("arr"=>array(1, 2, 3)), true);
//        var_dump($a);


    }
}