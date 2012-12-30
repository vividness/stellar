<?php

namespace Stellar\Kernel;

uses Stellar\Kernel\Config,
     Stellar\Kernel\Router,
     Stellar\Kernel\Dispatcher,
     Stellar\Kernel\RequestHandler;

/** 
 * App components factory
 */
class AppFactory implements AppFactoryInterface {
    
    /**
     * @return Config
     */
    public function createConfig() {
        return new Config();
    }

    /**
     * @return RequestHandler
     */
    public function createRequestHandler() {
        return new RequestHandler();
    }

    /**
     * @return Router
     */
    public function createRouter() { 
        return new Router();
    }

    /**
     * @return Dispatcher
     */
    public function createDispatcher() {
        return new Dispatcher();
    }
}
