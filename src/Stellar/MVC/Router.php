<?php 

namespace Stellar\MVC;

use RuntimeException,
    InvalidArgumentException, 
    Stellar\DI\ContainerInterface;

class Router implements RouterInterface {
    
    /** 
     * @param ContainerInterface
     */
    public function setContainer(ContainerInterface $container) {
        $this->container = $container;
    }
}
