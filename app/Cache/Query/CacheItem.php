<?php

namespace App\Cache\Query;

use App\Cache\CacheItemInterface;
use App\Cache\System\Redis;
use App\Database\Query\Query;

class CacheItem implements CacheItemInterface
{
    public function __construct(
        private Query $query,
        private Redis $redis
    ) {
    }

    public function getKey()
    {
        return md5($this->query->getQuery());
    }

    public function get()
    {
        return json_decode($this->redis->get($this->getKey()), true);
    }

    public function isHit()
    {
        return $this->redis->exists($this->getKey());
    }

    public function set($value)
    {
        $this->redis->setex($this->getKey(), $this->expiresAfter(), json_encode($value));
    }

    public function expiresAt($expiration = null)
    {
        return $this->redis->ttl;
    }

    public function expiresAfter($time = null)
    {
        return $this->redis->ttl;
    }
}