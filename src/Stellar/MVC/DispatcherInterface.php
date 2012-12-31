<?php

namespace Stellar\MVC;

use Stellar\DI\ContainerInterface;

/**
 * Dispatcher interface
 */ 
interface DispatcherInterface {
    
    /**
     * Responsible for loading additional dependencies 
     * and executing mapped method in controller
     */
    public function dispatch(ContainerInterface $params);
}
