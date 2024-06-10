<?php

namespace App\Cache\System;

class Redis extends \Redis
{
    public $ttl = 3600;
}