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
        $this->Factory = new AppFactory();
    }

    /**
     * Runs the application
     */
    public function run() {
        $this->setContainer($this->Factory->createContainer());

        $this->getContainer()
             ->addParam('Config',       $this->Factory->createConfig())
             ->addParam('Request',      $this->Factory->createRequest())
             ->addParam('Router',       $this->Factory->createRouter())
             ->addParam('Dispatcher',   $this->Factory->createDispatcher());

        $this->getContainer()
             ->getParam('Dispatcher')
             ->dispatch($this->getContainer());
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
