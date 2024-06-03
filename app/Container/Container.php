<?php

namespace App\Container;

use App\Controllers\AuthController;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Database\Connection;
use App\Database\Query\Query;
use App\Repository\PostRepository;
use App\Repository\UserRepository;

class Container
{
    private array $instances;

    public function __construct()
    {
        $this->instances = [
            Connection::class => fn () => new Connection(),
            Query::class => fn () => new Query($this->get(Connection::class)),
            UserRepository::class => fn () => new UserRepository($this->get(Connection::class)),
            PostRepository::class => fn () => new PostRepository($this->get(Query::class)),
            UserController::class => fn () => new UserController('user', $this->get(UserRepository::class)),
            AuthController::class => fn () => new AuthController('login', $this->get(UserRepository::class)),
            PostController::class => fn () => new PostController('post/all_posts', $this->get(PostRepository::class))
        ];
    }

    public function has(string $id): bool
    {
        return isset($this->instances[$id]);
    }

    public function get($key)
    {
        return $this->instances[$key]();
    }
}
