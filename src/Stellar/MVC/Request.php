<?php 

namespace Stellar\MVC;

use RuntimeException,
    InvalidArgumentException, 
    Stellar\MVC\RequestInterface;

class Request implements RequestInterface {

    /**
     * @var array Request data
     */
    protected $reqData = array();

    /**
     * @var string POST | GET | PUT | HEAD 
     */
    protected $reqType = null;

    /**
     * @param array $req
     */ 
    public function __construct($req = array()) {
        if (!is_array($req)) {
            $msg = 'Parameter must be an array';
            throw new InvalidArgumentException($msg);
        }
        
        if (!array_key_exists('get', $req) && isset($_GET)) {
            $req['get'] = $_GET;
        }

        if (!array_key_exists('post', $req) && isset($_POST)) {
            $req['post'] = $_POST;
        }    
        
        if (!array_key_exists('cookie', $req) && isset($_COOKIE)) {
            $req['cookie'] = $_COOKIE;
        }
        
        if (!array_key_exists('session', $req) && isset($_SESSION)) {
            $req['session'] = $_SESSION;
        }

        if (!array_key_exists('files', $req) && isset($_FILES)) {
            $req['files'] = $_FILES;
        }

        if (!array_key_exists('server', $req) && isset($_SERVER)) {
            $req['server'] = $_SERVER;
        }

        $this->setRequestData($req)
             ->setRequestType();
    }

    /**
     * @return  bool
     */
    public function isPost() {
        return $this->getRequestType() === 'POST';
    }

    /**
     * @return  bool
     */
    public function isGet() {
        return $this->getRequestType() === 'GET';
    }
 
    /**
     * @injectable
     * @param array $req
     * @return RequestInterface
     */
    public function setRequestType($type = null) {
        if ($type === null) {
            $req = $this->getRequestData();
           
            $type = isset($req['server']['REQUEST_METHOD']) ? 
                    $req['server']['REQUEST_METHOD'] :
                    null;
        }
        
        $this->reqType = $type;

        return $this;
    }
    
    /**
     * @return string 
     */
    public function getRequestType() {
        return $this->reqType;
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

        $this->reqData = $req;

        return $this;
    }
    
    /**
     * @return array 
     */
    public function getRequestData() {
        return $this->reqData;
    }
}
