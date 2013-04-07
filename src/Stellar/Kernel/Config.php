<?php 

namespace Stellar\Kernel;

use RuntimeException,
    InvalidArgumentException;

class Config implements ConfigInterface {
    
    /**
     * @var string
     */
    const DEFAULT_CONFIG_FILE = 'Config/app.ini'; 

    /**
     * @var string
     */
    private $configFilePath = null;
    
    /**
     * @var array
     */
    private $configData = array(); 
    
    /*
     * @param void
     */
    public function __construct() { 
        $this->setConfigFilePath()
             ->loadConfigData();
    }
   
   /**
     * @param string $section
     * @param string $param
     * @return mixed
     */
    public function read($section, $param) {
        if (!is_string($section)) {
            $msg = 'Invalid parameter ($section expected to be a string)';
            throw new InvalidArgumentException($msg);
        }

        if (!is_string($param)) {
            $msg = 'Invalid parameter ($param expected to be a string)';
            throw new InvalidArgumentException($msg);
        }
        
        if (!array_key_exists($section, $this->configData)) {
            $msg  = 'Section "' . $section . '" not defined. ';
            $msg .= 'Please check your ' . self::DEFAULT_CONFIG_FILE;
            throw new RuntimeException($msg);
        }
        
        if (!array_key_exists($param, $this->configData[$section])) {
            $msg  = 'Parameter "' . $param . '" not defined. ';
            $msg .= 'Please check your ' . self::DEFAULT_CONFIG_FILE;
            throw new RuntimeException($msg);
        }

        return $this->configData[$section][$param];
    }

    /**
     * @param string $path
     * @return ConfigInterface
     */
    private function setConfigFilePath($path = null) {
        if ($path === null) {
            $path = $this->defaultConfigFilePath();
        }
        
        if (!file_exists($path) || !is_file($path)) {
            $msg  = 'Config file does not exist! ';
            $msg .= 'Please make sure you have Config/app.ini file';
            throw new RuntimeException($msg);
        }

        $this->configFilePath = $path;

        return $this;
    }
    
    /**
     * @return string 
     */
    private function defaultConfigFilePath() {
        return APP_ROOT . '/' . self::DEFAULT_CONFIG_FILE;
    }

    /**
     * Load the configuration data into the object
     * @return ConfigInterafce
     */
    private function loadConfigData() {
        $this->configData = parse_ini_file(
            $this->getConfigFilePath(), 
            true
        );

        return $this;
    }
    
    /**
     * @return string
     */
    private function getConfigFilePath() {
        return $this->configFilePath;
    }
}
