<?php namespace EscapeWork\Cache;

class DriverTest extends \PHPUnit_Framework_TestCase
{
    
    public function assertPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Cache\Driver') );
    }

    public function testGetFileDriverShouldWork()
    {
        $options = array(
            'driver' => 'file', 
            'path'   => 'cache/'
        );

        $file = Driver::get( $options );
    }
}