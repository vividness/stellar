<?php

use Stellar\Kernel\Application;

define('ROOT',      realpath(__DIR__ . '/..'));
define('WWW_ROOT',  realpath(__DIR__));
define('APP_ROOT',  realpath(__DIR__ . '/../app'));

require_once ROOT . "/autoloader.php";

$app = new Application();
$app->run();

