<?php

use App\Application\Views\View;
use App\Application\Alerts\Alert;
use App\Application\Alerts\Error;
use App\Application\Config\Config;

?>

<!DOCTYPE html>
<html lang="<?php echo Config::get('app.lang'); ?>">

<head>
    <?php View::component('head'); ?>
    <title>Register</title>
</head>

<body>
    <?php View::component('nav'); ?>
    <?php View::component('register'); ?>
    <?php View::component('script') ?>
</body>

</html>