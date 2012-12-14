<?php 

namespace Stellar\Kernel;

use Stellar\DependencyInjection\Container,
    Stellar\Kernel\Config;

/**
 *  Top level application class
 */
class Application {
    
    /**
     * @var Stellar\DependencyInjection\Container
     */
    protected $DiContainter = null;
    
    /**
     * Config object
     * @var string 
     */
    protected $Config = null;

    /**
     * @param array App dependencies  
     */
    public function __construct (array $components) {
        if (!isset($components['Config']) || !($components['Config'] instanceof ConfigInterface)) {
            $msg = "Invalid Config object passed to Applicaiton constructor!";
            throw new InvalidArgumentException($msg);
        }

        $this->setConfig($components['Config']);

        if (!isset($components['DiContainter']) || !($components['DiContainter'] instanceof ContainerInterface)) {
            $msg = "Invalid Dependency Injection Container object passed to Application constructor";
            throw new InvalidArgumentException($msg);
        }

        $this->setDiContainer($components['DiContainer']);

        //add router, request handler and dispatcher
    }

    /**
     * @param ContainerInterface $DiContainer
     * @return Stellar\Kernel\Application
     */
    public function setDiContainer (ContainerInterface $DiContainer) {
        $this->DiContainer = $DiContainer;
        return $this;
    }

    /**
     * @return Stellar\DependencyInjection\ContainerInterface
     */
    public function getDiContainer () {
        return $this->DiContainer;
    }
    
    /**
     * @param Stellar\Kernel\ConfigInterface
     */
    public function setConfig (ConfigInterface $Config) {
        $this->Conifg = $Config;
        return $this;
    }

    /** 
     * @return Stellar\Kernel\Config 
     */ 
    public function getConfig () {
        return $this->Config;
    }
}
