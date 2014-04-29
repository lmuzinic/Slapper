<?php

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    protected $response = null;

    public function setUp()
    {
        $this->response = new \Slapper\Response('ok');
    }

    public function testProperties()
    {
        $this->assertObjectHasAttribute('success', $this->response);
        $this->assertObjectHasAttribute('message', $this->response);
    }

    public function testSuccess()
    {
        $this->response = new \Slapper\Response('ok');
        $this->assertTrue($this->response->isSuccessful());

        $this->response = new \Slapper\Response('No hooks');
        $this->assertFalse($this->response->isSuccessful());

        $this->response = new \Slapper\Response('Payload was not valid JSON');
        $this->assertFalse($this->response->isSuccessful());

        $this->response = new \Slapper\Response('No text specified');
        $this->assertFalse($this->response->isSuccessful());
    }

    public function tearDown()
    {
        unset($this->response);
    }
}
 