<?php
namespace Controllers;

class UsersController extends \MVCFramework\BaseController
{
    // route: /users
    public function home(){
        $this->view->appendToLayout('body', 'user.home');
        $this->view->display('layouts.users_home');
    }

    // route: /users/register
    public function register()
    {
        $this->view->appendToLayout('body', 'user.register');
        $this->view->display('layouts.user_acts');
    }

    // route: /users/register
    public function register2(){
        $this->view->appendToLayout('body', 'user.register');
        $this->view->display('layouts.user_acts');

        try{
            //if($this->input->getPost() )
            $userModel = new \Models\UserBindingModel(
                $this->input->getPost('username', 'string'),
                $this->input->getPost('password', 'hash'),
                $this->input->getPost('first_name', 'string'),
                $this->input->getPost('last_name', 'string'),
                $this->input->getPost('username', 'string')
            );

            $user = new \Models\User();
            $user->register($userModel);

            //$this->login($userModel->getUsername(), $userModel->getPassword());
        }catch(\Exception $ex){
            throw new \Exception('Can not register user.', 500);
        }
    }

    // route: /users/login
    public function login(){
        $this->view->appendToLayout('body', 'user.login');
        $this->view->display('layouts.user_acts');
    }

    public function login2($username, $password){
        $this->view->appendToLayout('body', 'user.login');
        $this->view->display('layouts.user_acts');
    }
}

