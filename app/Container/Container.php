<?php

namespace App\Container;

use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Database\Connection;
use App\Repository\UserRepository;

class Container {
    private array $instances;

    public function __construct()
    {
        $this->instances = [
            Connection::class => fn() => new Connection(),
            UserRepository::class => fn() => new UserRepository($this->get(Connection::class)),
            UserController::class => fn() => new UserController('user', $this->get(UserRepository::class)),
            AuthController::class => fn() => new AuthController('login', $this->get(UserRepository::class))
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