<?php

namespace App\Cache\System;

class Redis extends \Redis
{
    public $ttl = 3600;

    public function set($key, $value, $options = null)
    {
        $this->setex($key, $options, json_encode($value));
    }
}