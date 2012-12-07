<?php 

namespace Stellar\MVC;

/**
 * Application, top level object
 * @package Stellar.MVC
 */
class Application {    
    
    /**
     * For sure do some internal initializations, checks, load internal fw stuff
     */
    public function __construct ($config, $paths) {
    }

    /**
     * Build Application Dependecy Container 
     */
    public function buildDiContainer () {
        $this->DiContainer = null; 
    }

    /**
     * Find the application configuration and load 
     * the config into an object
     */
    public function loadAppConfig () {
        
    }

    /**
     * Once the setti
     */
    public function setAppConfig () {
        $this->settings
    }

}
