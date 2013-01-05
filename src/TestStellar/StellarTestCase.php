<?php 

namespace TestStellar;

use ReflectionMethod,
    PHPUnit_Framework_TestCase;

abstract class StellarTestCase extends PHPUnit_Framework_TestCase {
    
    /**
     * Helper method that uses Reflection to make private methods testable
     * @param string $class
     * @param string $method
     * return ReflectionMethod
     */
    public function makeMethodPublic($class, $method) {
        $method = new ReflectionMethod($class, $method);
        $method->setAccessible(true);
        
        return $method;
    }
}
