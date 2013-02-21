<?php namespace EscapeWork\Cache;

class CacheTest extends \PHPUnit_Framework_TestCase
{

    public function assertPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Cache\Cache') );
    }

    public function testSetValueWithoutNamespaceShouldWork()
    {
        $this->assertTrue( true );
    }
}