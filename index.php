<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/vendor/larapack/dd/src/helper.php";

use App\Application\App;

$app = new App();
$app->run();
