<?php namespace EscapeWork\Cache;

class ArrayDriverTest extends \PHPUnit_Framework_TestCase
{

    public function assertPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Cache\ArrayDriver') );
    }

    public function testAddValueToCacheShouldWork()
    {
        $array = new ArrayDriver();
        $array->set('key', 'value');

        $this->assertEquals('value', $array->get('key'));
    }

    public function testGetNonExistingValueShouldWork()
    {
        $array = new ArrayDriver();

        $this->assertFalse( $array->get('adsadssd') );
    }

    public function tearDown()
    {
        $array = new ArrayDriver();
        $array->flush();
    }
}