<?php

namespace App\Http\Middleware;

use App\Http\Interface\MiddlewareInterface;

abstract class Middleware implements MiddlewareInterface
{
    private $nextHandler;

    public function setNext(MiddlewareInterface $handler) {
        $this->nextHandler = $handler;

        return $handler;
    }

    public function check()
    {
        if ($this->nextHandler) {
            return $this->nextHandler->check();
        }

        return true;
    }
}