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
    public function createRequest(ContainerInterface $container);

    /** 
     * @param  ContainerIngterface $deps Dependency container
     * @return RouterInterface
     */
    public function createRouter(ContainerInterface $container);
    
    /**
     * @return DispatcherInterface
     */
    public function createDispatcher();
}
