<?php

use App\Application\Config\Config;
use App\Application\Views\View;
?>

<!DOCTYPE html>
<html lang="<?php Config::get('app.lang') ?>">

</html>

<head>
    <?php View::component('head') ?>
    <title><?php $title ?></title>
</head>

<body>
    <?php View::component('nav'); ?>

    <div class="container">
        <h1>404 - Page Not Found</h1>
        <p>Sorry, the page you are looking for does not exist.</p>
        <a href="/">Go back to Home</a>
    </div>
    <?php View::component('script') ?>
</body>

</html>