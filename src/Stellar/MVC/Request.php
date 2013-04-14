<?php 

namespace Stellar\MVC;

use RuntimeException,
    InvalidArgumentException, 
    Stellar\MVC\RequestInterface;

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
    public function __construct() {
        $reqestData = array(
            'get'     => isset($_GET)     ? $_GET     : null,
            'post'    => isset($_POST)    ? $_POST    : null,
            'cookie'  => isset($_COOKIE)  ? $_COOKIE  : null,
            'session' => isset($_SESSION) ? $_SESSION : null,
            'files'   => isset($_FILES)   ? $_FILES   : null,
            'server'  => isset($_SERVER)  ? $_SERVER  : null
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
            $msg = 'Parameter must be an array.';
            throw new InvalidArgumentException($msg);
        }

        $this->reqestData = $req;

        return $this;
    }
    
    /**
     * @return array 
     */
    public function &getRequestData() {
        return $this->reqestData;
    }

    /**
     * This method has a little bit of magic inside.
     * It has variable parameters. If the parameter 1 is 
     * provided, we will return the value from the $requestData array.
     * If we have param1 and param2 passed then we will set the param2 as
     * the value of the para1 key in the $requestData array.
     * 
     * example:
     *      $req = new Request();
     *      print $req->get('name'); // prints out the value of $_GET['name']
     *
     *      $req->get('name', 'Vladimir') // sets the value of $_GET['name'] to 'Vladimir';
     *      
     * @param string Key name
     * @param mixed  Value
     * @return null | mixed
     */
    public function get() {
        $argc = func_num_args();
        if ($argc > 2 || $argc < 1) {
            $msg = 'Invalid number of arguments.';
            throw new InvalidArgumentException($msg);
        }
         
        return $this->data('get', func_get_args());
    }

    /**
     * Getter and setter for $_POST data 
     * @param string Key name
     * @param mixed  Value
     * @return null | mixed
     */
    public function post() {
        $argc = func_num_args();
        if ($argc > 2 || $argc < 1) {
            $msg = 'Invalid number of arguments.';
            throw new InvalidArgumentException($msg);
        }
        
        return $this->data('post', func_get_args());
    }
     
    /**
     * Getter and setter for $_SESSION data 
     * @param string Key name
     * @param mixed  Value
     * @return null | mixed
     */
    public function session() {
        $argc = func_num_args();
        if ($argc > 2 || $argc < 1) {
            $msg = 'Invalid number of arguments.';
            throw new InvalidArgumentException($msg);
        }
        
        return $this->data('session', func_get_args());
    }

    /**
     * Getter and setter for $_COOKIE data 
     * @param string Key name
     * @param mixed  Value
     * @return null | mixed
     */
    public function cookie() {
        $argc = func_num_args();
        if ($argc > 2 || $argc < 1) {
            $msg = 'Invalid number of arguments.';
            throw new InvalidArgumentException($msg);
        }
        
        return $this->data('cookie', func_get_args());
    }
    
    /**
     * Getter and setter for $_FILES data 
     * @param string Key name
     * @param mixed  Value
     * @return null | mixed
     */
    public function files() {
        $argc = func_num_args();
        if ($argc > 2 || $argc < 1) {
            $msg = 'Invalid number of arguments.';
            throw new InvalidArgumentException($msg);
        }
        
        return $this->data('files', func_get_args());
    }

    /**
     * Getter and setter for $_SERVER data 
     * @param string Key name
     * @param mixed  Value
     * @return null | mixed
     */
    public function server() {
        $argc = func_num_args();
        if ($argc > 2 || $argc < 1) {
            $msg = 'Invalid number of arguments.';
            throw new InvalidArgumentException($msg);
        }
        
        return $this->data('server', func_get_args());
    }

    /**
     * Getter and setter for $this->requestData
     * @param string $global Key that represents one of the globals $_GET $_POST $_COOKIE
     * @param array  $params Key and value needed for setting/getting globals
     * @return mixed
     */
    private function data($global = null, $params = array()) {
        if ($global === null) {
            $msg = '$global not set.';
            throw new InvalidArgumentException($msg);
        }
        
        $valid_globals = array('get', 'post', 'cookie', 'files', 'server', 'session');
        if (!in_array($global, $valid_globals)) {
            $msg = '$global not valid.';
            throw new InvalidArgumentException($msg);
        }

        $argc = count($params);
        $key = $params[0];
        
        if ($argc === 1) {
            return $this->getRequestParam($global, $key);
        } else if ($argc === 2) {
            $value = $params[1];
            
            $this->setRequestParam($global, $key, $value);
            return;
        }
    }

    /**
     * Return Request data
     * eg:
     * $request->get('name'); //Returns $_GET['name'];
     *
     * @param $global Name of the first level key get|post|cookie|session
     * @param $key Second level key name
     * @return mixed
     */
    private function &getRequestParam($global = null, $key = null) {
        if ($global === null) {
            $msg = 'Invalid argument $global.';
            throw new InvalidArgumentException($msg);
        }
        
        if ($key === null) {
            $msg = 'Invalid argument $key.';
            throw new InvalidArgumentException($msg);
        }

        $data = &$this->getRequestData();
        
        if (!array_key_exists($key, $data[$global])) {
            $msg = 'Parameter could not be found.';
            throw new RuntimeException($msg);
        }

        return $data[$global][$key];
    }

    /**
     * Sets Request data
     * @param $global See ::getRequestParam
     * @param $key    See ::getRequestParam
     * @param $value
     * @return null
     */
    private function setRequestParam($global = null, $key = null, $value = null) {
        if ($global === null) {
            $msg = 'Invalid argument $global.';
            throw new InvalidArgumentException($msg);
        }
        
        if ($key === null) {
            $msg = 'Invalid argument $key.';
            throw new InvalidArgumentException($msg);
        }
        
        $data = &$this->getRequestData();
        
        if (!in_array($global, array_keys($data))) {
            $msg = 'Invalid $global value.';
            throw new InvalidArgumentException($msg);
        }
        
        $data[$global][$key] = $value;
        return;
    }

}
