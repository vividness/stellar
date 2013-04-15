<?php 

namespace Stellar\MVC;

use Stellar\DI\ContainerInterface;

class Dispatcher implements DispatcherInterface {

    /**
     * @param ContainerInterface $container
     */
    public function dispatch(ContainerInterface $container) {
        $router   = $container->getParam('Router');
        $request  = $container->getParam('Request');

        $routeMap = $router->getRouteMap($request);
        
        //TODO: Remove me once the tests are in place
        if (empty($routeMap)) return;

        $controller = new $routeMap['class']($container);
        $controller->{$routeMap['method']}();

        return $this;        
    }
}
