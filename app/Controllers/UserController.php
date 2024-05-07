<?php

namespace App\Controllers;

use App\Repository\Interface\RepositoryInterface;

class UserController extends \App\Http\AbstractController
{
    public function __construct(
        string $pageName,
        private RepositoryInterface $repository
    ) {
        parent::__construct($pageName);
    }

    public function get()
    {
        $id = $_SESSION['user'];
        $users = $this->repository->getByField('id', $id);
        var_dump($users);
        return 'users';
    }

    public function post()
    {
        $name = $this->getParam('name');
        $email = $this->getParam('email');
        $password = $this->getParam('email');
        $users = $this->repository->create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }
}
