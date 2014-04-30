<?php

class FieldTest extends \PHPUnit_Framework_TestCase
{
    protected $field = null;

    public function setUp()
    {
        $this->field = new Slapper\Field();
    }

    public function testProperties()
    {
        $this->assertObjectHasAttribute('title', $this->field);
        $this->assertObjectHasAttribute('value', $this->field);
        $this->assertObjectHasAttribute('short', $this->field);
        $this->assertAttributeInternalType('boolean', 'short', $this->field);
    }

    public function testPrepare()
    {
        $this->field->title = '"}';
        $this->field->value = '#new';

        $this->field->prepare();

        $this->assertEquals('%23new', $this->field->value);
        $this->assertEquals('%22%7D', $this->field->title);
    }

    public function tearDown()
    {
        unset($this->field);
    }
}
 