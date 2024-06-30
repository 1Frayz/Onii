<?php

use App\Application\Views\View;
use App\Application\Config\Config;

ob_start();
?>

<!doctype html>
<html lang="<?php Config::get('app.lang') ?>">

<head>
    <?php View::component('head') ?>
    <title><?php $title ?></title>
</head>

<body>
    <?php View::component('nav') ?>
    <?php View::component('post') ?>
    <?php View::component('script') ?>
    <?php ob_end_flush() ?>
</body>

</html>