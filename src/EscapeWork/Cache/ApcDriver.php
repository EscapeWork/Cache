<?php namespace EscapeWork\Cache;

class ApcDriver implements Cacheable
{
    
    public function set($key, $value = null)
    {
        apc_add($key, $value);
    }

    public function get( $key )
    {
        return apc_fetch($key);
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