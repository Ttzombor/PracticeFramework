<?php

namespace App\Database\Query;

use App\Database\Connection;
use PDO;
use Redis;

class Query
{
    /**
     * @param PDO $connection
     */
    public function __construct(
        private $connection
    ) {
        $this->connection = $connection->setup();
    }

    private function query(string $query)
    {
        try {
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            $cacheKey = md5($query);
            $cacheTTL = 3600;
        } catch (\RedisException $e) {
            $redis = null;
        }
        if ($redis && $redis->exists($cacheKey)) {
            $result = json_decode($redis->get($cacheKey), true);
        } else {
            $result = $this->connection->query($query)->fetchAll();
            $redis ? $redis->setex($cacheKey, $cacheTTL, json_encode($result)) : null;
        }
        return $result;
    }
    public function customSelect(string $query)
    {
        return $this->query($query);
    }
    public function insert($table, $data)
    {
        $keys = implode(',', array_keys($data));
        $values = implode(',', array_values($data));
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        $this->connection->exec($sql);
    }

    public function select($table, $columns = ['*'])
    {
        $columns = implode(',', $columns);
        $sql = "SELECT $columns FROM $table";
        return $this->connection->query($sql)->fetchAll();
    }

    public function update($table, $data, $id)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = $value,";
        }
        $set = rtrim($set, ',');
        $sql = "UPDATE $table SET $set WHERE id = $id";
        $this->connection->exec($sql);
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = $id";
        $this->connection->exec($sql);
    }


}