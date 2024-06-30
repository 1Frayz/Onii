<?php

use App\Application\Views\View;
use App\Application\Config\Config;

?>

<!doctype html>
<html lang="<?php Config::get('app.lang') ?>">

<head>
    <?php View::component('head') ?>
    <title><?php $title ?></title>
</head>

<body>
    <?php View::component('nav') ?>
    <?php View::component('followers') ?>
    <?php View::component('script') ?>
</body>

</html>