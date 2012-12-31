<?php 

namespace TestStellar\Unit\DI;

use TestStellar\StellarTestCase,
    Stellar\DI\Container;

class ContainerTest extends StellarTestCase {
    
    /**
     * @test
     * @return Container
     */
    public function createContainer() {
        $container = new Container();
        $interface = 'Stellar\DI\ContainerInterface';

        $this->assertInstanceOf($interface, $container);
        
        return $container;
    }

    /**
     * @test
     * @depends createContainer
     */
    public function addParamThrowsException(Container $container) {
        $this->setExpectedException('InvalidArgumentException');

        $container->addParam(1, '1');
    }

    /**
     * @test 
     * @depends createContainer
     */
    public function addParamPasses(Container $container) {
        $returnVal = $container->addParam('test', 1234);

        $interface = 'Stellar\DI\ContainerInterface';
        $this->assertInstanceOf($interface, $returnVal);

        return $container;
    }

    /**
     * @test
     * @depends addParamPasses
     */
    public function getParamThrowsException(Container $container) {
        $this->setExpectedException('OutOfBoundsException');

        $container->getParam(1);
    }

    /**
     * @test
     * @depends addParamPasses
     */ 
    public function getParamPasses(Container $container) {
        $this->assertEquals($container->getParam('test'), 1234);
    }

    /**
     * @test 
     * @depends addParamPasses
     */
    public function removeParamThrowsException(Container $container) {
        $this->setExpectedException('OutOfBoundsException');

        $container->removeParam(1);
    }

    /**
     * @test
     * @depends addParamPasses
     */
    public function removeParamPasses(Container $container) {
        $returnVal = $container->removeParam('test');
        $interface = 'Stellar\DI\ContainerInterface';

        $this->assertInstanceOf($interface, $returnVal);
    }
}
