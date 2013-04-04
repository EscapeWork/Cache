<?php namespace EscapeWork\Cache;

class CacheTest extends \PHPUnit_Framework_TestCase
{

    public function assertPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Cache\Cache') );
    }

    public function testSetNamespaceWorks()
    {
        $cache = Cache::getInstance(array('driver' => 'array'));
        $key   = $cache->setNamespaceKey('namespace');

        $this->assertEquals($key, $cache->getNamespaceKey('namespace'));
    }

    public function testSetAndGetWithNamespaceParametersShouldWork()
    {
        $cache = Cache::getInstance(array('driver' => 'array'));
        $cache->set('foo', 'bar', 'foobar');
        
        $this->assertEquals('bar', $cache->get('foo', null, 'foobar'));
    }

    public function testSetAndGetWithNamespaceSettedShouldWork()
    {
        $cache = Cache::getInstance(array('driver' => 'array'));
        $cache->setNamespace('foobar');
        $cache->set('foo', 'bar');

        $this->assertEquals('bar', $cache->get('foo'));
    }

    public function testSetByGetAnonymusFunction()
    {
        $cache = Cache::getInstance(array('driver' => 'array'));
        $value = $cache->get('foo', function()
        {
            return 'bar';
        });

        $this->assertEquals($value, $cache->get('foo'));
    }

    public function testDeleteKeyShouldWork()
    {
        $cache = Cache::getInstance(array('driver' => 'array'));
        $cache->set('foo', 'bar');
        $this->assertEquals('bar', $cache->get('foo'));

        $cache->delete('foo');
        $this->assertFalse($cache->get('foo'));
    }

    public function testSetValueWithoutNamespaceWorks()
    {
        $cache = Cache::getInstance(array('driver' => 'array'));
        $cache->setNamespace('namespace', true);

        $cache->set('foo', 'bar');
        $this->assertEquals('bar', $cache->get('foo'));
    }
}