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

        $data = &$this->getRequestData();
        
        if ($argc === 1) {
            $key = func_get_arg(0);

            if (!array_key_exists($key, $data['get'])) {
                $msg = 'Parameter could not be found.';
                throw new RuntimeException($msg);
            }

            return $data['get'][$key];
        } else if ($argc === 2) {
            $key   = func_get_arg(0);
            $value = func_get_arg(1);

            $data['get'][$key] = $value;
            return;
        }
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
     *      print $req->post('name'); // prints out the value of $_POST['name']
     *
     *      $req->post('name', 'Vladimir') // sets the value of $_POST['name'] to 'Vladimir';
     *      
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
    
        if ($argc === 1) {
            //TODO:
            return $this->getRequestParam('post', $key);
        } else if ($argc === 2) {
            $key   = func_get_arg(0);
            $value = func_get_arg(1);
            
            //TODO:
            $this->setRequestParam('post', $key, $value);
            return;
        }
    }
}
