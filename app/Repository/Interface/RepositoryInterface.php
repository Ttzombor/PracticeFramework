<?php

namespace App\Repository\Interface;

use App\Model\AbstractModel;

interface RepositoryInterface {

    public function create(array $params): AbstractModel;
    public function getByField(string $field, $value);

    public function getAll();

    public function update(): AbstractModel;

    public function delete($id): bool;
}