<?php

namespace App\Application\Helpers;

interface RandomInterface
{
    public static function str(int $length): string;
}
