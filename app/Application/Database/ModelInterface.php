<?php

namespace App\Application\Database;

interface ModelInterface
{

    public function find(string $column, mixed $value, bool $many = false): mixed;
    public function store(): void;
    public function update(array $data): void;

    public function all(): array;
}