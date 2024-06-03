<?php

namespace App\Repository;

use App\Database\Connection;
use App\Model\AbstractModel;
use App\Repository\Interface\RepositoryInterface;

class PostRepository implements RepositoryInterface
{
    private $connection;

    public function __construct(
        private Connection $databaseConnection
    ) {
        $this->connection = $databaseConnection->setup();
    }

    public function create(array $params)
    {
        list($title, $content, $user_id) = $params;
        $sth = $this->connection->prepare("INSERT INTO post (title, content, user_id) VALUES (?, ?, ?)");
        $sth->bindParam(1,$title);
        $sth->bindParam(2, $content);
        $sth->bindParam(3, $user_id);
        $sth->execute();
    }

    public function getByField(string $field, $value)
    {
        $query = $this->connection->query("SELECT * FROM post WHERE $field = '$value'");
        $result = $query->fetchAll();
        return $result;
    }

    public function getAll($page = 1)
    {
        $batchSize = 100;
        if ($page > 1) {
            $currentBatch = $batchSize * $page;
            $query = $this->connection->query(sprintf("SELECT *, (COUNT(*) OVER() / $batchSize) AS total_rows FROM post LIMIT %s OFFSET %d", $batchSize, $currentBatch));
        } else {
            $query = $this->connection->query(sprintf("SELECT *, (COUNT(*) OVER() / $batchSize) AS total_rows FROM post LIMIT %s", $batchSize));
        }

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