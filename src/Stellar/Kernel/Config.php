<?php 

namespace Stellar\Kernel;

class Config {
    /**
     *
     */
    public function __construct ($APP_ROOT) {
        $config     = $APP_ROOT . '/Config/app.php';
        $routes     = $APP_ROOT . '/Config/routes.php';
        $database   = $APP_ROOT . '/Config/database.php';
    }

    private function loadFile ($path) {
        
    }
}
