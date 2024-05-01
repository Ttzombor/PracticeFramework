<?php

namespace App\Controllers;

use App\Model\User;
use App\Notification\Notification;

class AuthController extends \App\Http\AbstractController
{
    public function login()
    {
        $name = $this->getParam('name');
        $password = $this->getParam('password');

        $user = User::getByName($name);
        if ($user) {
            $user = $user[0];
        } else {
            Notification::setNotification('Please enter a valid username and password.', 'danger') ;
            return 'login';
        }

        if (!$user) {
            return 'user not found';
        }
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['id'];
            Notification::setNotification('Well done!', 'success') ;
            return $this->redirect('/post');
        } else {
            Notification::setNotification('Please enter a valid username and password.', 'danger') ;
            $this->redirect('/login');
        }

    }

    public function logout()
    {
        unset($_SESSION['user']);
        Notification::setNotification('Success!', 'success') ;

        $this->redirect('/login');

    }
}