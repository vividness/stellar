<?php 

namespace Stellar\Kernel;

/**
 * Factory interfece that is widely used in the framework.
 * All major components should be instantiated by using this interface.
 */
interface AppFactoryInterface {
    
    /**
     * @return ConfigInterface
     */
    public function createConfig();

    /**
     * @return RequestInterface
     */
    public function createRequest();

    /** 
     * @return RouterInterface
     */
    public function createRouter();
    
    /**
     * @return DispatcherInterface
     */
    public function createDispatcher();
}
