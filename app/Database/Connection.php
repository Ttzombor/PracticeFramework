<?php

namespace App\Database;

use App\Database\Query\Query;

class Connection
{
    public function setup()
    {
        $databaseConfigs = self::getConfigs();
        $connection = new \PDO(
            $databaseConfigs['connection'] . ':host=' . $databaseConfigs['host'] . ';dbname=' . $databaseConfigs['dbname'],
            $databaseConfigs['username'],
            $databaseConfigs['password']
        );
        return $connection;
    }

//    public function query(string $query)
//    {
//        Query::query($query);
//    }

    public static function getConfigs()
    {
        $configs = require 'config/app.php';
        if (isset($configs['database'])) {
            return $configs['database'];
        } else {
            throw new \Exception("Database configuration not found", 500);
        }
    }
}
