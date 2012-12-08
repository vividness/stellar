<?php 

namespace Stellar\DependencyInjection;

use OutOfBoundsException,
    InvalidArgumentException,
    Stellar\DependencyInjection\ContainerInterface;

/**
 * Dependency Injection Container
 * @package Stellar\DependencyInjection
 */
class Container implements ContainerInterface {
    
    /**
     * Use to store params needed by the container
     * @var array
     */
    protected $params = array();

    /**
     * Use to store instances of dependent objects
     * @var array
     */
    protected $dependencies = array();

    /**
     * Container parameter setter
     * @param str $key
     * @param mixed $val
     * @return Stellar\DependencyInjection\Container
     */
    public function addParam ($key, $val) {
        if (!is_string($key)) {
            $msg = __METHOD__ . " called with an invalid key!";
            throw new InvalidArgumentException($msg);
        }
        $this->params[$key] = $val;
        return $this;
    }

    /** 
     * Container parameter unsetter
     * @param str $key
     * @return Stellar\DependencyInjection\Container
     */
    public function removeParam ($key) {
        if (!is_string($key) || !isset($this->params[$key])) {
            $msg = __METHOD__ . " called with an invalid key!";
            throw new OutOfBoundsException($msg);
        }

        unset($this->params[$key]);
        return $this;
    }

    /**
     * Returns param from the container
     * @param string $key
     * @return mixed
     */
    public function getParam ($key) {
        if (!is_string($key) || !isset($this->params[$key])) {
            $msg = __METHOD__ . " called with an invalid key!";
            throw new OutOfBoundsException($msg);
        }
        
        return $this->params[$key];
    }
    
    /**
     * Adds a dependency into the container and returns the instance of container 
     * @param string $key
     * @param callable $setupClosure
     * @return Stellar\DipendencyInjection\Container
     */
    public function addDependency ($key, $setupClosure) {
        if (!is_string($key) || !is_callable($setupClosure)) {
            $msg = __METHOD__ . " called with an invalid parameter!";
            throw new InvalidArgumentException($msg);
        }

        $this->dependencies[$key] = $setupClosure($this);
        return $this;
    }

    /**
     * Removes a dependency from the container and returns the container instance
     * @param string $key
     * @return Stellar\DependencyInjection\Container
     */
    public function removeDependency ($key) {
         if (!is_string($key) || !isset($this->dependency[$key])) {
            $msg = __METHOD__ . " called with an invalid key!";
            throw new OutOfBoundsException($msg);
        }

        unset($this->services[$key]);
        return $this;
    }

    /**
     * Returns the instance of a service
     * @param string $key
     * @return Stellar\DependencyInjection\ServiceInterface
     */
    public function getDependency ($key) {
        if (!is_string($key) || !isset($this->services[$key])) {
            $msg = __METHOD__ . " called with an invalid key!";
            throw new OutOfBoundsException($msg);
        }

        return $this->services[$name];
    }
}
