<?php 

namespace Stellar\MVC;

use Stellar\MVC\RequestInterface;

interface RouterInterface {
    
    /**
     * Returns an array containing Route Map params
     * @param RequestInterface $request
     * @return array
     */
    public function getRouteMap(RequestInterface $request);
}
