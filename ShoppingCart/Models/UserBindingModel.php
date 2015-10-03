<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 03.10.2015
 * Time: 17:47
 */

namespace Models;


class UserBindingModel
{
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $email;
    /**
     * @var \MVCFramework\Validator;
     */
    private $validator;

    public function __construct($username, $password, $firstName = null, $lastName = null, $email = null){
        $this->setUsername($username)
            ->setPassword($password)
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setEmail($email);
    }

    private function setValidator(){
        $this->validator = new \MVCFramework\Validator();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->validator->setRule('minLength', $username, 3);

        echo print_r($this->validator->validate());
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->validator->setRule('minLength', $password, 6);
        $this->validator->validate();
        $this->password = $password;
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->validator->setRule('email', $email);
        $this->validator->validate();
        $this->email = $email;
        return $this;
    }
}