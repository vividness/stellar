<?php 

namespace Stellar\MVC;

use Stellar\DependencyInjection\Container,
    Stellar\Core\Config;

/**
 *
 */
class Application {    
    static function run () {
        $app = new Application();
        //0. Create DIC and set it
        //1. load settings into DIC
        //2. Init MVC components such as Router, Dispatcher, RequestAdapter, RequestHandler
        //3. Call Dispatcher, Dispatcher calls Router in order to retrieve url to class-method mapping
        //4. Once result is retrieved, instantiate Controller, pass the DIC into contstuctor or make 
        //   sure Controller implements some interface that give us ability to manipulate the DIC
        //5. Then, Controller adds what Model(s) are going to be used into DIC 
    }

    /**
     * For sure do some internal initializations, checks, load internal fw stuff
     */
    public function __construct (Config $config) {
    }

    /**
     * Build Application Dependecy Container 
     */
    public function setDiContainer (Container $DiContainer) {
        $this->DiContainer = $DiContainer;
        return $this;
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
