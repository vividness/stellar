<?php

use Stellar\Kernel\Application,
    Stellar\Kernel\Config,
    Stellar\DependencyInjection\Container;

define('ROOT',      realpath('..'));
define('WWW_ROOT',  realpath('.'));
define('APP_ROOT',  realpath(ROOT . '/app'));

/* Initialize different components */
$Config         = new Config(APP_ROOT);
$DiContainer    = new Container();

$app = new Application(array(
    'Config' => $Config
    'DiContainer' => $DiContainer,
));

