<?php 

namespace Stellar\MVC;

use RuntimeException,
    InvalidArgumentException, 
    Stellar\DI\ContainerInterface,
    Stellar\MVC\RequestInterface;

class Router implements RouterInterface {
    
    /** 
     * @param ContainerInterface
     */
    public function setContainer(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * Returns an array containing Route Map params
     * @param RequestInterface $request
     * @return array
     */
    public function getRouteMap(RequestInterface $request) {
        return array();
    }
}
