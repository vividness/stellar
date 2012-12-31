<?php 

namespace Stellar\MVC;

uses Stellar\DI\ContainerInterface;

class Dispatcher implements DispatcherInterface {

    /**
     * @param ContainerInterface $params
     */
    public function dispatch($params) {
        die('IT WORKS!');        
    }
}
