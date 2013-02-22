<?php namespace EscapeWork\Cache;

class ApcDriver implements Cacheable
{

    public function __construct()
    {
        
    }
    
    public function set( $key, $value = null )
    {
        apc_add($key, $value);
    }

    public function get( $key )
    {
        apc_fetch($key);
    }

    public function delete( $key )
    {
        apc_delete($key);
    }

    public function flush()
    {
        apc_clear_cache();
    }
}