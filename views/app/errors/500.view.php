<?php

use App\Application\Config\Config;
use App\Application\Views\View;
?>

<!DOCTYPE html>
<html lang="<?php echo Config::get('app.lang'); ?>">

<head>
    <?php View::component('head') ?>
    <title><?php $title ?></title>
</head>

<body>
    <?php View::component('nav'); ?>

    <div class="container text-center">
        <h1 class="mt-5">500 - Internal Server Error</h1>
        <p class="lead">Oops! Something went wrong on our end. Please try again later.</p>
        <a href="/home" class="btn btn-primary">Go back to Home</a>
    </div>
    <?php View::component('script') ?>
</body>

</html>