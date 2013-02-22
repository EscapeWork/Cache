<?php namespace EscapeWork\Cache;

class FacadeTest extends \PHPUnit_Framework_TestCase
{

    public static function setUpBeforeClass()
    {
        File::setDirectory( 'cache' . DIRECTORY_SEPARATOR );
    }

    public function assertPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Cache\Facade') );
    }

    public function testSetAndGetValue()
    {
        Facade::set('foo', 'bar');

        $this->assertEquals('bar', Facade::get('foo'));
    }

    public function testSetAndGetValueWithNamespace()
    {
        Facade::set('key', 'value', 'cache', true);

        $this->assertEquals('value', Facade::get('key', null, 'cache'));
    }

    public function tearDown()
    {
        Facade::flush();
    }
}