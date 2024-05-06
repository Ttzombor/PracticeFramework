<?php

namespace App\Http\Interface;

interface MiddlewareInterface
{
    public function setNext(MiddlewareInterface $handler);

    public function check();
}
