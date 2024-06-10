<?php

namespace App\Cache\System;

class Memcached extends \Memcached
{
    public $ttl = 3600;

    public function exists($key)
    {
        $cachedValue = $this->get($key);
        if ($this->getResultCode() == Memcached::RES_NOTFOUND) {
            return false;
        } else {
            return true;
        }
    }
}