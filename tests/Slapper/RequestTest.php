<?php

class RequestTest extends \PHPUnit_Framework_TestCase
{
    protected $payload = null;
    protected $request = null;

    public function setUp()
    {
        $this->payload = new Slapper\Payload("Text that we send");
        $this->request = new \Slapper\Request($this->payload, parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'slapper.conf'));
    }

    public function testProperties()
    {
        $this->assertObjectHasAttribute('token', $this->request);
        $this->assertObjectHasAttribute('teamUrl', $this->request);
        $this->assertObjectHasAttribute('curlHandler', $this->request);
    }

    public function testSend()
    {
        $response = $this->request->send();

        $this->assertInstanceOf('Slapper\Response', $response);
    }

    public function tearDown()
    {
        unset($this->payload);
        unset($this->request);
    }
}
 