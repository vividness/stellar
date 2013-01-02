<?php

namespace TestStellar\Unit\Kernel;

use TestStellar\StellarTestCase,
    Stellar\Kernel\Application,
    Stellar\Kernel\AppFactory;

class ApplicationTest extends StellarTestCase {
    
    /**
     * @test
     */
    public function createApplication() {
        $app = new Application();

        $class = 'Stellar\Kernel\Application';
        $this->assertInstanceOf($class, $app);
        
        $factory = $app->getFactory();
        $interface = 'Stellar\Kernel\AppFactoryInterface';
        $this->assertInstanceOf($interface, $factory);
        
        $container = $app->getContainer();
        $interface = 'Stellar\DI\ContainerInterface';
        $this->assertInstanceOf($interface, $container);

        return $app;
    }
    
    /**
     * @test
     * @depends createApplication
     */
    public function setFactory(Application $app) {
        $anotherFactory = new AppFactory();

        $returnVal = $app->setFactory($anotherFactory);

        $class = 'Stellar\Kernel\Application';
        $this->assertInstanceOf($class, $returnVal);
        
        return $app;
    }

    /**
     * @test
     * @depends setFactory
     */
    public function getFactory(Application $app) {
        $factory = $app->getFactory();

        $interface = 'Stellar\Kernel\AppFactoryInterface';
        $this->assertInstanceOf($interface, $factory);
    }
    
    /**
     * @test 
     * @depends createApplication
     */
    public function setContainer(Application $app) {
        $container = $app->getFactory()->createContainer();
        $returnVal = $app->setContainer($container);

        $class = 'Stellar\Kernel\Application';
        $this->assertInstanceOf($class, $returnVal);

        return $app;
    }

    /**
     * @test
     * @depends setContainer
     */
    public function getContainer(Application $app) {
        $container = $app->getContainer();

        $interface = 'Stellar\DI\ContainerInterface';
        $this->assertInstanceOf($interface, $container);
    }

    /**
     * @test
     * @depends createApplication
     */
    public function applicationRun(Application $app) {
        $returnVal = $app->run();

        $this->assertEquals(null, $returnVal);
    }
}
