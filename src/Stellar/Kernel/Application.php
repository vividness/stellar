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
    protected $Params = null;
    
    /**
     * @var ApplicationFactory
     */
    protected $Factory = null;

    /**
     * Initialize instance members only, do not assign dependencies here
     * leave that for ::run()
     */
    public function __construct() {
        if (!defined('ROOT')) {
            $msg = 'Framework root directory not defined';
            throw new RuntimeException($msg);
        }
        
        if (!defined('APP_ROOT')) {
            $msg = 'Application root directory not defined';
            throw new RuntimeException($msg);
        }
        
        $factory = new AppFactory();
        $container = $factory->createContainer();

        $this->setFactory($factory);
        $this->setContainer($container);
    }

    /**
     * Runs the application
     */
    public function run() {
        $factory    = $this->getFactory();
        $container  = $this->getContainer();
        
        /* 
        $config     = $factory->createConfig(); //TODO: pass the container to the object
        $request    = $factory->createRequest();
        $router     = $factory->createRouter($container);
        $dispatcher = $factory->createDispatcher($container);
        */

        $container->addParam('Config',     $factory->createConfig())
                  ->addParam('Request',    $factory->createRequest())
                  ->addParam('Router',     $factory->createRouter($container))
                  ->addParam('Dispatcher', $factory->createDispatcher($container));
         
        $container->getParam('Dispatcher')
                  ->dispatch($container);

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
