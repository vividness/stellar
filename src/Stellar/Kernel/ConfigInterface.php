<?php

namespace Stellar\Kernel;

interface ConfigInterface {

    /**
     * @param string $section
     * @param string $param
     * @return mixed
     */
    public function read($section, $param);
}
