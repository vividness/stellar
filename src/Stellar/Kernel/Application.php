<?php 

namespace Stellar\Kernel;

use Stellar\DI\Container,
    Stellar\Kernel\Config;

/**
 *  Top level application class
 */
class Application {
    
    /**
     * @var Stellar\DependencyInjection\Container
     */
    protected $Container = null;
    
    /**
     * @var Stellar\Kernel\ApplicationFactory
     */
    protected $Factory = null;

    /**
     * Initialize instance members only, do not assign dependencies here
     * leave that for ::run()
     */
    public function __construct () {
        $this->Factory = new AppFactory();
        $this->setContainer($this->Factory->createContainer());
    }

    /**
     * Runs the application
     */
    public function run () {
        $this->getContainer()->addParam('Config', $this->Factory->createConfig());
        $this->getContainer()->addParam('Router', $this->Factory->createRouter());
        $this->getContainer()->addParam('Dispatcher', $this->Factory->createDispatcher());

        $this->getContainer()->getParam('Dispatcher')->dispatch($this->getContainer());
    }

    /**
     * @param ContainerInterface $DiContainer
     * @return Stellar\Kernel\Application
     */
    public function setContainer (ContainerInterface $container) {
        $this->Container = $container;
        return $this;
    }

    /**
     * @return Stellar\DependencyInjection\ContainerInterface
     */
    public function getContainer () {
        return $this->Container;
    }
}
