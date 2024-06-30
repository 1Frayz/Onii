<?php

namespace App\Application\Router;

interface RouteInterface
{
    public static function page(string $uri, string $controller, string $method, array|string $middleware = []): void;

    public static function list(): array;

    public static function post(string $uri, string $controller, string $method, array|string $middleware = []): void;
    public static function dynamic(string $uriPattern, string $controller, string $method, array|string $middleware = []): void;
}
