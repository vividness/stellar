<?php 

namespace Stellar\Kernel;

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
