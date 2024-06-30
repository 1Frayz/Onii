<?php

namespace App\Application;

use App\Application\Router\Router;
use App\Application\Router\Route;
use App\Exceptions\ViewNotFoundException;
use App\Exceptions\ComponentNotFoundException;
use App\Application\Views\View;
use App\Application\Config\Config;
use App\Application\Auth\Auth;
use PDOException;

class App
{
    public function run(): void
    {
        try {
            $this->handle();
        } catch (ViewNotFoundException | ComponentNotFoundException | PDOException $e) {
            if (Config::get("app.debug")) {
                View::exception($e);
            } else {
                View::error(500);
            }
        }
    }

    private function handle(): void
    {
        Config::init();
        require_once __DIR__ . "/../../routes/actions.php";
        require_once __DIR__ . "/../../routes/pages.php";
        $router = new Router();
        Auth::init();
        $router->handle(Route::list());
    }
}