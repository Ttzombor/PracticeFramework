<?php

namespace App\Model;

use App\Database\Connection;

class User
{
    public static function create($params)
    {
        $connection = Connection::setup();
        $date = date('Y-m-d H:i:s');
        $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);
        $query = $connection->prepare("INSERT INTO user (name, password, updated_at, created_ay) VALUES (:name, :password, :updated_at, :created_at)");
        $query->execute([
            'name' => $params['name'],
            'password' => $params['password'],
            'updated_at' => $date,
            'created_at' => $date
        ]);
    }

    public static function all()
    {
        $connection = Connection::setup();
        $query = $connection->query('SELECT * FROM user');
        $result = $query->fetchAll();
        return $result;
    }

    public static function getById($id)
    {
        $connection = Connection::setup();
        $query = $connection->query("SELECT * FROM user WHERE id = $id");
        $result = $query->fetchAll();
        return $result;
    }

    public static function getByName(mixed $name)
    {
        $connection = Connection::setup();
        $query = $connection->query("SELECT * FROM user WHERE name = '$name'");
        $result = $query->fetchAll();
        return $result;
    }
}
