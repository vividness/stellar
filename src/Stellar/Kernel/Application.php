<?php 

namespace Stellar\Kernel;

use RuntimeException,
    Stellar\Kernel\AppFactory,
    Stellar\DI\ContainerInterface;

/**
 *  Top level application class
 */
class Application {
    
    /**
     * @var ContainerInterface
     */
    protected $Params;
    
    /**
     * @var ApplicationFactory
     */
    protected $Factory;

    /**
     * Initialize instance members only, do not assign dependencies here
     * leave that for ::run()
     */
    public function __construct() {
        if (!defined('ROOT')) {
            $msg = 'Project root directory not defined!';
            throw new RuntimeException($msg);
        }
        
        if (!defined('APP_ROOT')) {
            $msg = 'Application root directory not defined!';
            throw new RuntimeException($msg);
        }
        
        $factory = new AppFactory();
        $container = $factory->createContainer();

        $this->setFactory($factory);
        $this->setContainer($container);
    }

    /**
     * Runs the application. This is where the default
     * container setup is happening.
     */
    public function run() {
        $factory    = $this->getFactory();
        $container  = $this->getContainer();
        
        /**
         * TODO: check if the parameters are already set
         *       and if they are skip initialization. 
         */
        $request    = $factory->createRequest($container);
        $router     = $factory->createRouter($container);
        $dispatcher = $factory->createDispatcher($container);
        
        $container->addParam('Router',     $router)
                  ->addParam('Request',    $request)
                  ->addParam('Dispatcher', $dispatcher);
         
        $dispatcher->dispatch($container);

        return;
    }

    /**
     * @param AppFactory $factory
     * @return Application
     */
    public function setFactory(AppFactoryInterface $factory) {
        $this->Factory = $factory;
        return $this;
    }
    
    /**
     * @return AppFactoryInterafce
     */
    public function getFactory() {
        return $this->Factory;
    }

    /**
     * @param ContainerInterface $Container
     * @return Application
     */
    public function setContainer(ContainerInterface $cont) {
        $this->Params = $cont;
        return $this;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer() {
        return $this->Params;
    }
}
