<?php

namespace App\Cache\System;

class Redis extends \Redis
{
    public $ttl = 3600;
    public function __construct()
    {
        if (!extension_loaded('redis') && !$this->getConfigs()) {
            //throw new \Exception('Redis extension not loaded');
        } else {
            parent::__construct($this->getConfigs());

        }
    }

    public static function create()
    {
        return new self();
    }

    private function getConfigs()
    {
        $configs = require 'config/app.php';
        if (isset($configs['cache']) && isset($configs['cache']['sql'])) {
            if ($configs['cache']['sql']['driver'] == 'redis') {
                unset($configs['cache']['sql']['driver']);
            }
            return $configs['cache']['sql'];
        } else {
            return null;
        }
    }
}