<?php

namespace Stellar\Kernel;

use Stellar\DI\Container,
    Stellar\DI\ContainerInterface,
    Stellar\Kernel\Config,
    Stellar\MVC\Request,
    Stellar\MVC\Router,
    Stellar\MVC\Dispatcher;

class AppFactory implements AppFactoryInterface {
   
    /**
     *@return ContainerInterface
     */
    public function createContainer() {
        return new Container();
    }
    
    /**
     * @return ConfigInterface
     */
    public function createConfig() {
        return new Config();
    }

    /**
     * @return RequestInterface
     */
    public function createRequest(ContainerInterface $container) {
        return new Request($container);
    }

    /**
     * @return RouterInterface
     */
    public function createRouter(ContainerInterface $container) { 
        return new Router($container);
    }

    /**
     * @return DispatcherInterface
     */
    public function createDispatcher() {
        return new Dispatcher();
    }
}
