<?php

namespace App\Repository;

use App\Database\Connection;
use App\Model\AbstractModel;
use App\Repository\Interface\RepositoryInterface;

class UserRepository implements RepositoryInterface
{
    private $connection;

    public function __construct(
        private Connection $databaseConnection
    ) {
        $this->connection = $databaseConnection->setup();
    }

    public function create(array $params): AbstractModel
    {
        $date = date('Y-m-d H:i:s');
        $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);
        $query = $this->connection->prepare("INSERT INTO user (name, password, updated_at, created_ay) VALUES (:name, :password, :updated_at, :created_at)");
        $query->execute([
            'name' => $params['name'],
            'password' => $params['password'],
            'updated_at' => $date,
            'created_at' => $date
        ]);
    }

    public function getByField(string $field, $value)
    {
        $query = $this->connection->query("SELECT * FROM user WHERE $field = '$value'");
        $result = $query->fetchAll();
        return $result;
    }

    public function getAll()
    {
        $query = $this->connection->query('SELECT * FROM user');
        $result = $query->fetchAll();
        return $result;
    }

    public function update(): AbstractModel
    {
        // TODO: Implement update() method.
    }

    public function delete($id): bool
    {
        // TODO: Implement delete() method.
    }


}