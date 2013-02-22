<?php namespace EscapeWork\Cache;

use \Memcache;

class MemcachedDriver implements Cacheable
{

    protected $object, $options;

    public function __construct( $options )
    {
        $this->options = $options;
        $this->object  = new Memcache();
        $this->connect();
    }

    private function connect()
    {
        foreach( $this->options['cache.memcached'] as $server )
        {
            $this->object->connect( 
                $server['host'], 
                $server['port'] 
            );
        }
    }

    public function set( $key, $value = null )
    {
        $this->object->set($key, $value);
    }

    public function get( $key )
    {
        return $this->object->get($key);
    }

    public function delete( $key )
    {
        return $this->object->delete($key);
    }

    public function flush()
    {
        $this->object->flush();
    }
}