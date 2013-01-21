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
     * @injectable
     * @param array $req
     * @return RequestInterface
     */
    public function setRequestType($type = null);

    /**
     * @return string 
     */
    public function getRequestType();

    /**
     * @injectable
     * @param array $req
     * @return RequestInterface
     */
    public function setRequestData($req = array());

    /**
     * @return array 
     */
    public function getRequestData();
}
