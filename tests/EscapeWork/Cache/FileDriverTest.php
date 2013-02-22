<?php namespace EscapeWork\Cache;

class FileDriverTest extends \PHPUnit_Framework_TestCase
{

    public $file;
    
    public function assertPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Cache\FileDriver') );
    }

    public function setUp()
    {
        $options = array(
            'cache.path' => 'cache' . DIRECTORY_SEPARATOR
        );

        $this->file = new FileDriver( $options );
    }

    public function testAddValueToCacheShouldWork()
    {
        $this->file->set('key', 'value');

        $this->assertEquals('value', $this->file->get('key'));
    }

    public function testGetNonExistingValueShouldWork()
    {
        $this->assertFalse( $this->file->get(null) );
    }

    public function testAddDeleteAndGetNonExistingValueShouldWork()
    {
        $this->file->set('foo', 'bar');
        $this->assertEquals('bar', $this->file->get('foo'));

        $this->file->delete('foo');

        $this->assertFalse( $this->file->get('foo') );
    }

    public function tearDown()
    {
        $this->file->flush();
    }
}