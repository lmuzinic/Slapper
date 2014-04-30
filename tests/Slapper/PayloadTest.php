<?php

class PayloadTest extends \PHPUnit_Framework_TestCase
{
    protected $payload = null;

    public function setUp()
    {
        $this->payload = new Slapper\Payload("Text that we send");
    }

    public function testProperties()
    {
        $this->assertObjectHasAttribute('channel', $this->payload);
        $this->assertObjectHasAttribute('username', $this->payload);
        $this->assertObjectHasAttribute('text', $this->payload);
        $this->assertObjectHasAttribute('icon_emoji', $this->payload);
        $this->assertObjectHasAttribute('fallback', $this->payload);
        $this->assertObjectHasAttribute('pretext', $this->payload);
        $this->assertObjectHasAttribute('color', $this->payload);
        $this->assertObjectHasAttribute('fields', $this->payload);
        $this->assertInternalType('array', $this->payload->fields);
    }

    public function testPrepare()
    {
        $this->payload->channel = "#test";
        $this->payload->icon_emoji = ":smile:";
        $this->payload->text = '"}';

        $this->payload->prepare();

        $this->assertEquals('%23test', $this->payload->channel);
        $this->assertEquals('%3Asmile%3A', $this->payload->icon_emoji);
        $this->assertEquals('%22%7D', $this->payload->text);
    }

    public function tearDown()
    {
        unset($this->payload);
    }
}