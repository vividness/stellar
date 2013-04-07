<?php 

namespace Stellar\Kernel;

use Stellar\DI\ContainerInterface;

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
     * @param  ContainerIngterface $deps Dependency container
     * @return RouterInterface
     */
    public function createRouter(ContainerInterface $deps);
    
    /**
     * @return DispatcherInterface
     */
    public function createDispatcher();
}
