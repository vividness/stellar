<?php 

namespace Stellar\MVC;

use Stellar\DI\ContainerInterface;

class Dispatcher implements DispatcherInterface {

    /**
     * @param ContainerInterface $params
     */
    public function dispatch(ContainerInterface $params) {
        return $this;        
    }
}
