<?php

namespace App\Cache\System\Query;

use App\Cache\System\Memcached;
use App\Cache\System\Redis;

class CacheDriver implements \App\Cache\System\CacheDriver
{
    public static function load()
    {
        $configs = require 'config/app.php';
        if (isset($configs['cache']) && isset($configs['cache']['sql'])) {
            if ($configs['cache']['sql']['driver'] == 'redis') {
                unset($configs['cache']['sql']['driver']);
                return new Redis($configs['cache']['sql']);
            }
            if ($configs['cache']['sql']['driver'] == 'memcached') {
                unset($configs['cache']['sql']['driver']);
                $memcached = new Memcached();
                $memcached->addServers([[$configs['cache']['sql']['host'], $configs['cache']['sql']['port']]]);
                return $memcached;
            }
        }
        return false;
    }
}
