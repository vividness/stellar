<?php

namespace Stellar\MVC;

interface RequestInterface {
    
    /**
     * @return  bool
     */
    public function isPost();

    /**
     * @return  bool
     */
    public function isGet();

    /**
     * @param array $req
     * @return RequestInterface
     */
    public function setRequestMethod($type = null);

    /**
     * @return string 
     */
    public function getRequestMethod();

    /**
     * @param array $req
     * @return RequestInterface
     */
    public function setRequestData($req = array());

    /**
     * @return array 
     */
    public function &getRequestData();

    /**
     * Read-write $_GET
     * @return mixed | null 
     */
    public function get();
    
    /**
     * Read-write $_POST
     * @return mixed | null
     */
    public function post();
    
    /**
     * Read-write $_SESSION
     * @return mixed | null
     */
    public function session();
    
    /**
     * Read-write $_COOKIE
     * @return mixed | null 
     */
    public function cookie();
    
    /**
     * Read $_FILES 
     * @return mixed
     */
    public function files();
    
    /**
     * Read $_SERVER variable
     * @return mixed
     */
    public function server();
}
