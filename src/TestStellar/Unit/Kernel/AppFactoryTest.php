<?php 

namespace TestStellar\Unit\Kernel;

use TestStellar\StellarTestCase,
    Stellar\Kernel\AppFactory;

class AppFactoryTest extends StellarTestCase {
    
    /**
     * @test
     */
    public function createAppFactory() {
        $factory = new AppFactory();
        
        $interface = 'Stellar\Kernel\AppFactoryInterface';
        $this->assertInstanceOf($interface, $factory);
        
        return $factory;
    }

    /**
     * @test
     * @depends createAppFactory
     */
    public function createContainer(AppFactory $factory) {
        $returnVal = $factory->createContainer();
        
        $interface = 'Stellar\DI\ContainerInterface';
        $this->assertInstanceOf($interface, $returnVal);
    }

    /**
     * @test
     * @depends createAppFactory
     */
    public function createConfig(AppFactory $factory) {
        $returnVal = $factory->createConfig();

        $interface = 'Stellar\Kernel\ConfigInterface';
        $this->assertInstanceOf($interface, $returnVal);
    }

    /**
     * @test
     * @depends createAppFactory
     */
    public function createRequest(AppFactory $factory) {
        $returnVal = $factory->createRequest();

        $interface = 'Stellar\MVC\RequestInterface';
        $this->assertInstanceOf($interface, $returnVal);
    }
 
    /**
     * @test
     * @depends createAppFactory
     */
    public function createRouter(AppFactory $factory) {
        $deps = $factory->createContainer();
        $returnVal = $factory->createRouter($deps);

        $interface = 'Stellar\MVC\RouterInterface';
        $this->assertInstanceOf($interface, $returnVal);
    }

    /**
     * @test
     * @depends createAppFactory
     */
    public function createDispatcher(AppFactory $factory) {
        $returnVal = $factory->createDispatcher();

        $interface = 'Stellar\MVC\DispatcherInterface';
        $this->assertInstanceOf($interface, $returnVal);
    }
}
