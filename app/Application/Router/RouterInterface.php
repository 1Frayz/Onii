<?php

namespace App\Application\Router;

interface RouterInterface
{
    public function handle(array $routes): void;
    public static function match(string $requestUri, string $requestMethod): void;
}
