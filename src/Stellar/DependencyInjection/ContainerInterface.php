<?php 

namespace Stellar\DependencyInjection

/**
 * @package Stellar\DependencyInjection
 */
interface ContainerInterface {
    /**
     * @param string $key
     * @param mixed $val
     * @return Stellar\DependencyInjection\ContainerInterface
     */
    public function addParam ($key, $val);

    /**
     * @param string $key
     * @return Stellar\DependencyInjection\ContainerInterface
     */
    public function removeParam ($key);

    /**
     * @param string $key 
     * return mixesd
     */
    public function getParam ($key);

    /**
     * @param string $key
     * @param callable $setupClosure
     * @return Stellar\DependencyInjection\ContainerInterface
     */
    public function addDependency ($key, $setupClosure);

    /**
     * @param string $key
     * @return Stellar\DependencyInjection\ContainerInterface
     */
    public function removeDependency ($key);

    /**
     * @param string $key
     * @return Stellar\DependencyInjection\DependencyInterface
     */
    public function getDependency ($key);
}
