<?php

namespace App\Controllers;

use App\Repository\Interface\RepositoryInterface;

class PostController extends \App\Http\AbstractController
{
    public function __construct(
        private string $pageName,
        private RepositoryInterface $repository
    ) {
        parent::__construct($pageName);
    }

    public function get()
    {
        $_SESSION['post'] = '123';
        return $this->pageName;
    }

    public function getAll()
    {
        $currentPage = (int)$this->getParam('p') ?? 1;
        $posts = $this->repository->getAll($currentPage);
        return [$this->pageName, ['posts' => $posts]];
    }
    public function post()
    {
        return $this->redirect('/');
    }
}
