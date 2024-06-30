<?php

namespace App\Application\Router;

class Redirect implements RedirectInterface
{
    public static function to(string $route): void
    {
        header("Location: $route");
        die();
    }

    public static function toProfile(string $route): void
    {
        header("Location: /profile/$route");
        die();
    }
    public static function Update(): void
    {
        header('Location: ' . $_SERVER['PHP_SELF']);
        die;
    }

    public static function Referer(): void
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die;
    }
}
