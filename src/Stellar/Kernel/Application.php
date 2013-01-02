<?php 

namespace Stellar\Kernel;

use Stellar\Kernel\AppFactory,
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
        $this->setFactory(new AppFactory());
        
        $factory = $this->getFactory();
        $this->setContainer($factory->createContainer());
    }

    /**
     * Runs the application
     */
    public function run() {
        $factory   = $this->getFactory();
        $container = $this->getContainer();

        $container
            ->addParam('Config',     $factory->createConfig())
            ->addParam('Request',    $factory->createRequest())
            ->addParam('Router',     $factory->createRouter())
            ->addParam('Dispatcher', $factory->createDispatcher());
        
        $dispatcher = $container->getParam('Dispatcher');
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
