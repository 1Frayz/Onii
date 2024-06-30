<?php

namespace App\Application\Auth;

use App\Application\Database\Model;
use App\Models\User;
use App\Application\Config\Config;

class Auth implements AuthInterface
{
    protected static $model;
    protected static $user;
    protected static ?string $token;
    protected static string $tokenColumn;

    use AuthHelper;

    public static function init(): void
    {
        $model = Config::get("auth.model");
        self::$tokenColumn = Config::get("auth.token_column");
        self::$model = new $model();
        self::$token = $_COOKIE[self::$tokenColumn] ?? NULL;
    }

    public static function check(): bool
    {
        self::$user = self::$model->find(self::$tokenColumn, self::$token);
        return self::$user instanceof Model;
    }

    public static function user(): ?Model
    {
        if (self::$user === null) {
            self::$user = self::$model->find(self::$tokenColumn, self::$token);
        }

        return self::$user instanceof Model ? self::$user : null;
    }

    public static function getTokenColumn(): string
    {
        return self::$tokenColumn;
    }

    public static function id(): ?int
    {
        $user = self::user();
        return $user ? $user->id() : null;
    }
}
