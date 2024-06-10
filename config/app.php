<?php

return [
    'database' => [
        'connection' => 'mysql',
        'host' => "127.0.0.1",
        'port' => 3306,
        'username' => 'root',
        'password' => 'qwerty123',
        'dbname' => 'practice'
    ],
    'cache' => [
        'sql' => [
            'driver' => 'memcached',
            'host' => '127.0.0.1',
            'port' => 11211
        ],
        'page' => []
    ],
    'mode' => 'development'
];