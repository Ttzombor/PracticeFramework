<?php

namespace App\Controllers;

use App\Model\User;

class UserController extends \App\Http\AbstractController
{
    public function get()
    {
        $id = $this->getParam('id');
        $users = User::getById($id);
        var_dump($users);
        return 'users';
    }

    public function post()
    {
        $name = $this->getParam('name');
        $email = $this->getParam('email');
        $password = $this->getParam('email');
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }
}
