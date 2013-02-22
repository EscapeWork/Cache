<?php namespace EscapeWork\Cache;

class FileDriverTest extends \PHPUnit_Framework_TestCase
{
    
    public function assertPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Cache\FileDriver') );
    }

    public function setUp()
    {
        FileDriver::setDirectory( 'cache' . DIRECTORY_SEPARATOR );
    }

    public function testAddValueToCacheShouldWork()
    {
        $file = new FileDriver();
        $file->set('key', 'value');

        $this->assertEquals('value', $file->get('key'));
    }

    public function testGetNonExistingValueShouldWork()
    {
        $file = new FileDriver();

        $this->assertFalse( $file->get(null) );
    }

    public function tearDown()
    {
        $file = new FileDriver();
        $file->flush();
    }
}