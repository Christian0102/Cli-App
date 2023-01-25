<?php 
declare(strict_types=1);

define('ROOT', __DIR__);

require_once(__DIR__ . '/vendor/autoload.php');

use Kernel\App;

$app = new App();

$app->run();