<?php 

namespace TestStellar\Unit\MVC;

use TestStellar\StellarTestCase,
    Stellar\MVC\RequestInterface,
    Stellar\MVC\Request,
    Stellar\Kernel\AppFactory;

class RequestTest extends StellarTestCase {
   
    /**
     * Provide request data as it would be in $_POST, $_GET, etc
     */
    public function setRequestGlobals() {
        $_GET     = array('param1' => 'val1');
        $_POST    = array('param2' => 'val2');
        $_COOKIE  = array('param3' => 'val3');
        $_SESSION = array('param4' => 'val4');
        $_FILES   = array(
            'testFile' => array(
                'name'      => 'dummy.txt',
                'type'      => 'fileType',
                'tmp_name'  => APP_ROOT . '/tmp/d1u2m3m4y5.txt',
                'error'     => 0,
                'size'      => 12345
            )
        );

        $_SERVER = array(
            'param5'         => 'val5',
            'REQUEST_METHOD' => 'GET'
        );
    }
    
    /**
     * @test
     * @return RequestInterface
     */
    public function createRequest() {
        $this->setRequestGlobals();
        $factory = new AppFactory();

        $req = new Request();

        $interface = 'Stellar\MVC\RequestInterface';
        $this->assertInstanceOf($interface, $req);
        
        return $req;
    }
 
    /**
     * @test 
     * @depends createRequest
     * @param RequestInterface
     */
    public function isPost(RequestInterface $req) {
        $expected = false;
        $returnVal = $req->isPost();
        
        $this->assertEquals($expected, $returnVal);
    } 
   
    /**
     * @test 
     * @depends createRequest
     */
    public function isGet(RequestInterface $req) {
        $expected = true;
        $returnVal = $req->isGet();

        $this->assertEquals($expected, $returnVal);
    }

    /**
     * @test
     * @depends createRequest
     */
    public function setRequestType(RequestInterface $req) {
        $interface = 'Stellar\MVC\RequestInterface';
        $returnVal = $req->setRequestMethod();

        $this->assertInstanceOf($interface, $returnVal);
    }

    /**
     * @test 
     * @depends createRequest
     */
    public function getRequestType(RequestInterface $req) {
        $returnVal = $req->getRequestMethod();
        $expected  = 'GET';

        $this->assertEquals($expected, $returnVal);
    }

    /**
     * @test
     * @depends createRequest
     */
    public function setRequestDataThrowsException(RequestInterface $req) {
        $exception = 'InvalidArgumentException';
        $this->setExpectedException($exception);

        $req->setRequestData('BOOM!');
    }        

    /**
     * @test
     * @depends createRequest
     */
    public function setRequestData(RequestInterface $req) {
        $interface = 'Stellar\MVC\RequestInterface';

        $returnVal = $req->setRequestData(array('test' => 'pass'));
        $this->assertinstanceOf($interface, $returnVal);

        return $req;
    }

    /**
     * @test
     * @depends createRequest
     */
    public function getRequestData(RequestInterface $req) {
        $expected = array('test' => 'pass');
        $returnVal = $req->getRequestData();

        $this->assertEquals($expected, $returnVal);
    }

    /**
     * @test
     * @depends createRequest
     */
    public function getThrowsException(RequestInterface $req) {
        $exception = 'InvalidArgumentException';
        $this->setExpectedException($exception);
        
        $req->get();
    }

    /**
     * @test
     * @depends createRequest
     */
    public function getMethod() {
        $req = new Request();
        $req->get('name', 'Vladimir');
        
        $expected = 'Vladimir';
        $returnVal = $req->get('name');

        $this->assertEquals($expected, $returnVal);
        return $req;
    }

    /**
     * @test 
     * @depends getMethod
     */
    public function getMethodThrowsException(RequestInterface $req) {
        $exception = 'RuntimeException';
        $this->setExpectedException($exception);
        
        $req->get('totallyOff');
    }
}
