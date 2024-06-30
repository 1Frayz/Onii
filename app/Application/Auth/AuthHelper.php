<?php

namespace App\Application\Auth;

trait AuthHelper
{
    public static function username(): ?string
    {
        $user = self::user();
        return $user ? $user->getUsername() : null;
    }

    public static function email(): ?string
    {
        $user = self::user();
        return $user ? $user->getEmail() : null;
    }

    public static function avatar(): ?string
    {
        $user = self::user();
        return $user ? $user->getAvatar() : null;
    }
}
