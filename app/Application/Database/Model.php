<?php

namespace App\Application\Database;

use App\Application\Database\Connection;

class Model extends Connection implements ModelInterface
{
    protected array $fields = [];
    protected string $table;
    protected int $id;
    protected string $created_at;
    protected string $updated_at;

    protected array $collection = [];

    public function created_at()
    {
        return $this->created_at;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function find(string $column, mixed $value, bool $many = false): mixed
    {
        $query = "SELECT * FROM `$this->table` WHERE `$column` = :$column ORDER BY id DESC";
        $stmt = self::connect()->prepare($query);
        $stmt->execute([$column => $value]);

        return $this->processResults($stmt, $many);
    }

    public function findByConditions(array $conditions, bool $many = false): mixed
    {
        $whereClauses = [];
        foreach ($conditions as $column => $value) {
            $whereClauses[] = "`$column` = :$column";
        }
        $whereClause = implode(' AND ', $whereClauses);

        $query = "SELECT * FROM `$this->table` WHERE $whereClause ORDER BY id DESC";
        $stmt = self::connect()->prepare($query);
        $stmt->execute($conditions);

        return $this->processResults($stmt, $many);
    }

    private function processResults($stmt, bool $many): mixed
    {
        if ($many) {
            $items = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $this->collection = [];
            foreach ($items as $item) {
                $entity = clone $this;
                foreach ($item as $key => $value) {
                    $entity->$key = $value;
                }
                $this->collection[] = $entity;
            }
            return $this->collection;
        } else {
            $entity = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!$entity) {
                return false;
            }
            foreach ($entity as $key => $value) {
                $this->$key = $value;
            }
            return $this;
        }
    }

    public function store(): void
    {
        $columns = implode(", ", array_map(function ($field) {
            return "`$field`";
        }, $this->fields));

        $binds = implode(", ", array_map(function ($field) {
            return ":$field";
        }, $this->fields));

        $query = "INSERT INTO `{$this->table}` ($columns) VALUES ($binds)";
        $stmt = $this->connect()->prepare($query);
        $params = [];
        foreach ($this->fields as $field) {
            $params[$field] = $this->$field ?? NULL;
        }

        $stmt->execute($params);
    }

    public function update(array $data): void
    {
        $keys = array_keys($data);
        $fields = array_map(function ($item) {
            return "`$item` = :$item";
        }, $keys);

        $updatedFields = implode(", ", $fields);
        $query = "UPDATE `$this->table` SET $updatedFields WHERE `id` = :id";
        $stmt = $this->connect()->prepare($query);
        $data['id'] = $this->id;
        $stmt->execute($data);
    }

    public function all(): array
    {
        $items = $this->connect()->query("SELECT * FROM `$this->table` ORDER BY id DESC")->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($items as $item) {
            foreach ($item as $key => $value) {
                $this->$key = $value;
            }
            $this->collection[] = clone $this;
        }
        return $this->collection;
    }

    public function delete(): bool
    {
        if (!isset($this->id)) {
            return false;
        }

        $query = "DELETE FROM `$this->table` WHERE `id` = :id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['id' => $this->id]);

        return $stmt->rowCount() > 0;
    }

    public function search(string $query, string $column): array
    {
        $whereClauses[] = "`$column` LIKE :$column";
        $params[$column] = '%' . $query . '%';
        $whereClause = implode(' OR ', $whereClauses);
        $sql = "SELECT * FROM `$this->table` WHERE $whereClause ORDER BY id DESC";
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);

        return $this->processResults($stmt, true);
    }
}
