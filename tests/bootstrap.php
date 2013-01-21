<?php 

define('ROOT', realpath(__DIR__ . '/..'));
define('APP_ROOT', ROOT . '/src/TestStellar/Fixtures/Unit/app');

require_once ROOT . '/autoloader.php';

/**
 * FIXME: start application and while creating Config() 
 * pass the container and populate it with the config data
 */

 /**
  * FIXME: Create container builder
  */

/*
  TODO: New way of build container
        
        $builder = new AppBuilder();

        $builder->createContainer()
                ->loadConfig()
                ->createRequest()
                ->createRouter()
                ->createDispatcher();

        $container = $builder->build();
*/
