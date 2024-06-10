<?php

namespace App\Cache\Query;

use App\Cache\CacheItemInterface;
use App\Cache\System\Query\CacheDriver;
use App\Cache\System\Redis;
use App\Database\Query\Query;

class CacheItem implements CacheItemInterface
{
    public $cacheDriver;
    public function __construct(
        private Query $query
    ) {
        $this->cacheDriver = CacheDriver::load();
    }


    public function getKey()
    {
        return md5($this->query->getQuery());
    }

    public function get()
    {
        return json_decode($this->cacheDriver->get($this->getKey()), true);
    }

    public function isHit()
    {
        return $this->cacheDriver->exists($this->getKey());
    }

    public function set($value)
    {
        $this->cacheDriver->setex($this->getKey(), $this->expiresAfter(), json_encode($value));
    }

    public function expiresAt($expiration = null)
    {
        return $this->cacheDriver->ttl;
    }

    public function expiresAfter($time = null)
    {
        return $this->cacheDriver->ttl;
    }
}