<?php

namespace App\Application\Alerts;

interface ErrorInterface
{
    public static function list(): array;
    public static function has(string $key): bool;
    public static function store(array $errors): void;
    public static function get(string $key, bool $all = false): null|string|array;
}
