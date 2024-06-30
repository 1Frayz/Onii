<?php

namespace App\Application\Router;

use App\Application\Views\View;

class Router implements RouterInterface
{
    use RouterHelper;

    public function handle(array $routes): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        $type = $requestMethod == 'POST' ? 'post' : 'page';

        foreach ($routes as $route) {
            if ($route['type'] === 'dynamic') {
                $pattern = preg_replace('/\{[^\}]+\}/', '([^/]+)', $route['uri']);
                $pattern = "@^" . $pattern . "$@";

                if (preg_match($pattern, $uri, $matches)) {
                    array_shift($matches);
                    if (!empty($route['middleware'])) {
                        $middleware = new $route['middleware']();
                        $middleware->handle();
                    }
                    self::controller($route, $matches);
                    return;
                }
            } elseif ($route['uri'] === $uri && strtolower($route['type']) === strtolower($type)) {
                if (!empty($route['middleware'])) {
                    $middleware = new $route['middleware']();
                    $middleware->handle();
                }
                self::controller($route);
                return;
            }
        }

        View::error(404);
    }

    public static function match(string $requestUri, string $requestMethod): void
    {
        $routes = Route::list();
        $type = $requestMethod == 'POST' ? 'post' : 'page';

        foreach ($routes as $route) {
            if ($route['type'] === 'dynamic') {
                $pattern = preg_replace('/\{[^\}]+\}/', '([^/]+)', $route['uri']);
                $pattern = "@^" . $pattern . "$@";

                if (preg_match($pattern, $requestUri, $matches)) {
                    array_shift($matches);
                    self::controller($route, $matches);
                    return;
                }
            } elseif ($route['uri'] === $requestUri && strtolower($route['type']) === strtolower($type)) {
                self::controller($route);
                return;
            }
        }

        View::error(404);
    }
}
