<?php namespace EscapeWork\Cache;

class DriverTest extends \PHPUnit_Framework_TestCase
{
    
    public function assertPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Cache\Driver') );
    }

    public function testGetFileDriverShouldWork()
    {
        $file = Driver::get('file');
    }

    public function testGetApcDriverShouldWork()
    {
        $file = Driver::get('apc');
    }
}