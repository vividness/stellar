<?php 

namespace Stellar\Kernel;

/**
 * Factory interfece that is widely used in the framework.
 * All major components should be instantiated by using this interface.
 */
interface AppFactoryInterface {
    
    /**
     * @return Config
     */
    public function createConfig();

    /**
     * @return RequestHandler
     */
    public function createRequestHandler();

    /** 
     * @return Router
     */
    public function createRouter();
    
    /**
     * @return Dispatcher
     */
    public function createDispatcher();
}
