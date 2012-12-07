<?php 

namespace Stellar\DependencyInjection;

/**
 * Dependency Injection Container
 */
class Container implements ContainerInterface {
    
    /**
     * Arbitary parameters needed by the container
     *
     * @var array
     */
    protected $params = array();

    /**
     *
     */
    protected $services = array();

    /**
     * Container parameter setter
     *
     * @param str $key
     * @param mixed $val
     * @return void
     */
    public function setParam ($key, $val) {
        /* NOTE: Should I try to prevent param overwriting? Let's see that later :) */
        $this->params[$key] = $val;
        return true;
    }

    /** 
     * Container parameter unsetter
     * 
     * @param str $key
     * @return void
     */
    public function unsetParam ($key) {
        if (!is_string($key)) {
            $msg = __METHOD__ . " called with an invalid parameter!"; 
            throw new InvalidArgumentException($msg);
        }

        if (!isset($this->params[$key])) {
            $msg = __METHOD__ . " called with an invalid key!";
            throw new OutOfBoundsException($msg);
        }

        unset($this->params[$key]);
    }

    /**
     * Arbitary container param getter
     *
     * @param string $key
     * @return mixed
     */
    public function getParam ($key) {
        if (!is_string($key)) {
            $msg = __METHOD__ . " called with an invalid parameter!"; 
            throw new InvalidArgumentException($msg);
        }

        if (!isset($this->params[$key])) {
            $msg = __METHOD__ . " called with an invalid key!";
            throw new OutOfBoundsException($msg);
        }
        
        return $this->params[$key];
    }

    /**
     * Quick and dirty
     */
    public function getService ($service) {
       return $this->objects[$service]->createService($this->params);
    }

    /**
     * $service should be a factory object that has to 
     * have createService() method implemented
     */
    public function setService ($service) {
        
    }
}
