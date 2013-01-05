<?php 

namespace TestStellar\Unit\Kernel;

use ReflectionMethod,
    TestStellar\StellarTestCase,
    Stellar\Kernel\ConfigInterface,
    Stellar\Kernel\Config;

class ConfigTest extends StellarTestCase {
    
    /**
     * @test
     */
    public function createConfig() {
        $config = new Config();
        
        $interface = 'Stellar\Kernel\ConfigInterface';
        $this->assertInstanceOf($interface, $config);
        
        return $config;
    }

    /**
     * @test
     * @depends createConfig
     */
    public function readThrowsInvalidSection(ConfigInterface $config) {
        $this->setExpectedException('InvalidArgumentException');

        $config->read(100, 'param1');
    }

    /**
     * @test
     * @depends createConfig
     */
    public function readThrowsInvalidParam(ConfigInterface $config) {
        $this->setExpectedException('InvalidArgumentException');

        $config->read('section', 1000);
    }

    /**
     * @test
     * @depends createConfig
     */
    public function readThrowsSectionNotDefined(ConfigInterface $config) {
        $this->setExpectedException('RuntimeException');

        $config->read('IamNotThere', 'param1');
    }

    /**
     * @test
     * @depends createConfig
     */
    public function readThrowsParamNotDefined(ConfigInterface $config) {
        $this->setExpectedException('RuntimeException');

        $config->read('test section', 'nowIamNotThere');
    }

    /**
     * @test
     * @depends createConfig
     */
    public function readPasses(ConfigInterface $config) {
        $returnVal = $config->read('test section', 'param2');

        $this->assertEquals($returnVal, '12345');
    }
    
    /**
     * @test
     * @depends createConfig
     */
    public function setConfigFilePathFails(ConfigInterface $config) {
        $this->setExpectedException('RuntimeException');
        
        $className = 'Stellar\Kernel\Config';
        $methodName = 'setConfigFilePath';

        $method = $this->makeMethodPublic($className, $methodName);
        $method->invoke($config, '/tmp');
    }
    
    /**
     * @test
     * @depends createConfig
     */
    public function setConfigFilePasses(ConfigInterface $config) {
        $className = 'Stellar\Kernel\Config';
        $methodName = 'setConfigFilePath';

        $method = $this->makeMethodPublic($className, $methodName);
        $returnVal = $method->invoke($config);
        
        $interface = 'Stellar\Kernel\ConfigInterface';
        $this->assertInstanceOf($interface, $returnVal);
    }

    /**
     * @test
     * @depends createConfig
     */
    public function defaultConfigFile(ConfigInterface $config) {
        $className = 'Stellar\Kernel\Config';
        $methodName = 'defaultConfigFilePath';

        $method = $this->makeMethodPublic($className, $methodName);
        $returnVal = $method->invoke($config);
        
        $iniPath = APP_ROOT . '/Config/app.ini';
        $this->assertEquals($returnVal, $iniPath);
    }

    /**
     * @test
     * @depends createConfig
     */
    public function loadConfigData(ConfigInterface $config) {
        $className = 'Stellar\Kernel\Config';
        $methodName = 'loadConfigData';

        $method = $this->makeMethodPublic($className, $methodName);
        $returnVal = $method->invoke($config);

        $interface = 'Stellar\Kernel\ConfigInterface';
        $this->assertInstanceOf($interface, $returnVal);
    }

    /**
     * @test 
     * @depends createConfig
     */
    public function getConfigFilePath(ConfigInterface $config) {
        $className = 'Stellar\Kernel\Config';
        $methodName = 'getConfigFilePath';

        $method = $this->makeMethodPublic($className, $methodName);
        $returnVal = $method->invoke($config);

        $iniPath = APP_ROOT . '/Config/app.ini';
        $this->assertEquals($returnVal, $iniPath);
    }
} 
