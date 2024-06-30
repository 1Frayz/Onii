<?php

namespace App\Application\Upload;

use App\Application\Config\Config;


class Upload implements UploadInterface
{
    public static function file(array $file, string $to = 'files'): bool|string
    {
        $storage = __DIR__ . "/../../../" .  Config::get("app.storage_folder");
        $path = "$storage/$to";
        self::checkFolder($path);
        $fileName = date('d-m-Y') . uniqid() . "-" . $file['name'];
        if (!move_uploaded_file($file['tmp_name'], "$path/$fileName")) {
            return false;
        }
        return  Config::get("app.storage_folder") . "/$to/$fileName";
    }

    private static function checkFolder(string $path): void
    {
        if (!is_dir($path)) {
            mkdir($path);
        }
    }
}
