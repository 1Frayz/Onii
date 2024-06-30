<?php

namespace App\Application\Router;

class Route implements RouteInterface
{
    private static $routes = [];
    public static function page(string $uri, string $controller, string $method, array|string $middleware = []): void
    {
        self::$routes[] = [
            "uri" => $uri,
            "type" => 'page',
            "controller" => $controller,
            "method" => $method,
            "middleware" => $middleware,
        ];
    }

    public static function dynamic(string $uriPattern, string $controller, string $method, array|string $middleware = []): void
    {
        self::$routes[] = [
            "uri" => $uriPattern,
            "type" => 'dynamic',
            "controller" => $controller,
            "method" => $method,
            "middleware" => $middleware,
        ];
    }

    public static function list(): array
    {
        return self::$routes;
    }

    public static function post(string $uri, string $controller, string $method, array|string $middleware = []): void
    {
        self::$routes[] = [
            "uri" => $uri,
            "type" => "post",
            "controller" => $controller,
            "method" => $method,
            "middleware" => $middleware,
        ];
    }
}
