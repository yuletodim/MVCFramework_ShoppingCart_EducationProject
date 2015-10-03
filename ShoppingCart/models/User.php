<?php
namespace Models;

class User
{
    public function register(\Models\UserBindingModel $user)
    {
        $db = new \MVCFramework\DB\SimpleDB();

        if ($this->exists($user->getUsername())) {
            throw new \Exception("User already registered");
        }

        $result = $db->prepare("
            INSERT INTO users (username, password, first_name, last_name, email)
            VALUES (?, ?, ?, ?, ?);
        ");

        $result->execute(
            [
                $user->getUsername(),
                $user->getPassword(),
                $user->getFirstName(),
                $user->getLastName(),
                $user->getEmail()
            ]
        );

        if ($result->getAffectedRows() > 0) {
            return true;
        } else {
            throw new \Exception('Cannot register user');
        }
    }

    public function exists($username)
    {
        $db = new \MVCFramework\DB\SimpleDB();

        $result = $db->prepare("SELECT id FROM users WHERE username = ?");
        $result->execute([ $username ]);

        return $result->rowCount() > 0;
    }
}