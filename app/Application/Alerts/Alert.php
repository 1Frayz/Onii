<?php

namespace App\Application\Alerts;

class Alert implements AlertInterface
{
    public const DANGER = "danger";
    public const SUCCESS = "success";

    public static function storeMessage(string $message, string $type = "error"): void
    {
        setcookie("message.$type", $message, time() + 3600, "/");
    }

    public static function success(bool $clear = false): ?string
    {
        $message = $_COOKIE['message_' . self::SUCCESS] ?? null;
        if ($clear) {
            unset($_COOKIE['message_' . self::SUCCESS]);
            setcookie('message.' . self::SUCCESS, NULL, time() - 3600, "/");
        }
        return $message;
    }

    public static function danger(bool $clear = false): ?string
    {
        $message = $_COOKIE['message_' . self::DANGER] ?? null;
        if ($clear) {
            unset($_COOKIE['message_' . self::DANGER]);
            setcookie('message.' . self::DANGER, NULL, time() - 3600, "/");
        }
        return $message;
    }
}
