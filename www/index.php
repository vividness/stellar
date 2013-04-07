<?php

use Stellar\Kernel\Application;

define('ROOT',      realpath(__DIR__ . '/..'));
define('WWW_ROOT',  realpath(__DIR__));
define('APP_ROOT',  realpath(__DIR__ . '/../app'));

require_once APP_ROOT . "/bootstrap.php";

$app = new Application();
$app->run();

<<<<<<< Updated upstream
print "All clear!\n";
=======
print_r($app);
>>>>>>> Stashed changes
