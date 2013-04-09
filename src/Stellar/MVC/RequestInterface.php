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
    public function getRequestData();
}
