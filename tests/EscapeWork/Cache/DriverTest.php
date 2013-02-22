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
            'cache.driver' => 'file', 
            'cache.path'   => 'cache/'
        );

        $file = Driver::get( $options );
    }
}