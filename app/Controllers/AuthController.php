<?php

namespace App\Controllers;

use App\Http\Request;
use App\Notification\NotificationCollector;
use App\Repository\Interface\RepositoryInterface;

class AuthController extends \App\Http\AbstractController
{
    public function __construct(
        string $pageName,
        private RepositoryInterface $repository
    ) {
        parent::__construct($pageName);
    }

    public function login()
    {
        $name = $this->getParam('name');
        $password = $this->getParam('password');

        $user = $this->repository->getByField('name', $name);
        if ($user) {
            $user = $user[0];
        } else {
            NotificationCollector::setNotification('Please enter a valid username and password.', 'danger') ;
            return 'login';
        }

        if (!$user) {
            return 'user not found';
        }
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['id'];
            NotificationCollector::setNotification('Well done!', 'success') ;
            if (Request::getUri() == '/login') {
                return $this->redirect('/post');
            }
            return $this->redirect(Request::getUri());
        } else {
            NotificationCollector::setNotification('Please enter a valid username and password.', 'danger') ;
            $this->redirect('/login');
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        NotificationCollector::setNotification('Success!', 'success') ;

        $this->redirect('/login');
    }
}
