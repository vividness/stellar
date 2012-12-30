<?php

use Stellar\Kernel\Application;

define('ROOT',      realpath('..'));
define('WWW_ROOT',  realpath('.'));
define('APP_ROOT',  realpath(ROOT . '/app'));

$app = new Application();
$app->run();

