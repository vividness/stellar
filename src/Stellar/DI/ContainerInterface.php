<?php 

namespace Stellar\DI;

interface ContainerInterface {
    /**
     * @param string $key
     * @param mixed $val
     * @return ContainerInterface
     */
    public function addParam($key, $val);

    /**
     * @param string $key
     * @return ContainerInterface
     */
    public function removeParam($key);

    /**
     * @param string $key 
     * return mixesd
     */
    public function getParam($key);

    /**
     * @param string $key
     * @param callable $setupClosure
     * @return ContainerInterface
     */
    public function addDependency($key, $setupClosure);

    /**
     * @param string $key
     * @return ContainerInterface
     */
    public function removeDependency($key);

    /**
     * @param string $key
     * @return DependencyInterface
     */
    public function getDependency($key);
}
