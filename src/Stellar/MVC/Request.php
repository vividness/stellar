<?php 

namespace Stellar\MVC;

use RuntimeException,
    InvalidArgumentException, 
    Stellar\MVC\RequestInterface,
    Stellar\DI\ContainerInterface;

class Request implements RequestInterface {

    /**
     * @var array Request data
     */
    protected $reqestData = array();

    /**
     * @var string POST | GET | PUT | HEAD 
     */
    protected $reqestMethod;

    /**
     * Create the Request object from the globals
     * @param ContainerInterface
     */ 
    public function __construct(ContainerInterface $container) {
        $reqestData = array(
            'get'     => $_GET,
            'post'    => $_POST,
            'cookie'  => $_COOKIE,
            'session' => isset($_SESSION) ? $_SESSION : null,
            'files'   => $_FILES,
            'server'  => $_SERVER
        );

        $this->setRequestData($reqestData)
             ->setRequestMethod();
    }

    /**
     * @return  bool
     */
    public function isPost() {
        return $this->getRequestMethod() === 'POST';
    }

    /**
     * @return  bool
     */
    public function isGet() {
        return $this->getRequestMethod() === 'GET';
    }
 
    /**
     * @injectable
     * @param array $req
     * @return RequestInterface
     */
    public function setRequestMethod($type = null) {
        if ($type === null) {
            $req = $this->getRequestData();
           
            $type = isset($req['server']['REQUEST_METHOD']) ? 
                    $req['server']['REQUEST_METHOD'] :
                    null;
        }
        
        $this->reqestMethod = $type;

        return $this;
    }
    
    /**
     * @return string 
     */
    public function getRequestMethod() {
        return $this->reqestMethod;
    }

    /**
     * @injectable
     * @param array $req
     * @return Request
     */
    public function setRequestData($req = array()) {
        if (!is_array($req)) {
            $msg = 'Parameter must be an array';
            throw new InvalidArgumentException($msg);
        }

        $this->reqestData = $req;

        return $this;
    }
    
    /**
     * @return array 
     */
    public function getRequestData() {
        return $this->reqestData;
    }
}
