<?php namespace EscapeWork\Cache;

class FileTest extends \PHPUnit_Framework_TestCase
{
    
    public function assertPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Cache\File') );
    }

    public function setUp()
    {
        File::setDirectory( 'cache' . DIRECTORY_SEPARATOR );
    }

    public function testAddValueToCacheShouldWork()
    {
        $file = new File();
        $file->set('key', 'value');

        $this->assertEquals('value', $file->get('key'));
    }

    public function testGetNonExistingValueShouldWork()
    {
        $file = new File();

        $this->assertFalse( $file->get(null) );
    }

    public function tearDown()
    {
        $file = new File();
        $file->flush();
    }
}