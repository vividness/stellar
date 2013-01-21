<?php 

namespace TestStellar\Unit\MVC;

use TestStellar\StellarTestCase,
    Stellar\MVC\RequestInterface,
    Stellar\MVC\Request;

class RequestTest extends StellarTestCase {
   
    /**
     * Provide request data as it would be in $_POST, $_GET, etc
     */
    public function provideRequestData() {
        $req = array(
            'get'       => array('param1' => 'val1'),
            'post'      => array('param2' => 'val2'),
            'cookie'    => array('param3' => 'val3'),
            'session'   => array('param4' => 'val4'),
            'files'     => array(
                'testFile' =>array(
                    'name'      => 'dummy.txt',
                    'type'      => 'fileType',
                    'tmp_name'  => APP_ROOT . '/tmp/d1u2m3m4y5.txt',
                    'error'     => 0,
                    'size'      => 12345
                )
            ),
            'server'    => array(
                'param5'            => 'val5',
                'REQUEST_METHOD'    => 'GET'
            )
        );

        return $req;
    }
    
    /**
     * @test 
     */
    public function constructorThrowsException() {
        $exception = 'InvalidArgumentException';
        $this->setExpectedException($exception);
        
        $requestData = 'string';
        $req = new Request($requestData);
    }

    /**
     * @test
     * @depends constructorThrowsException
     * @return RequestInterface
     */
    public function createRequest() {
        $requestData = $this->provideRequestData();
        $req = new Request($requestData);

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
        $returnVal = $req->setRequestType();

        $this->assertInstanceOf($interface, $returnVal);
    }

    /**
     * @test 
     * @depends createRequest
     */
    public function getRequestType(RequestInterface $req) {
        $returnVal = $req->getRequestType();
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
        $reqData   = $this->provideRequestData();
        $interface = 'Stellar\MVC\RequestInterface';

        $returnVal = $req->setRequestData($reqData);
        $this->assertinstanceOf($interface, $returnVal);

        return $req;
    }

    /**
     * @test
     * @depends createRequest
     */
    public function getRequestData(RequestInterface $req) {
        $expected  = $this->provideRequestData();
        $returnVal = $req->getRequestData();

        $this->assertEquals($expected, $returnVal);
    }
}
