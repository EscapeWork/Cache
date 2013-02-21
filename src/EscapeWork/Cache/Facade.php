<?php namespace EscapeWork\Cache;

class Facade
{
    public static $driver = 'file';

    public static function setDriver( $driver )
    {
        static::$driver = $driver;
    }

    public static function set( $key, $value, $namespace = null )
    {
        $cache = Cache::getInstance( static::$driver );
        $cache->set( $key, $value, $namespace = null );
    }

    public static function get( $key, $callback = null, $namespace = null )
    {
        $cache = Cache::getInstance( static::$driver );
        $cache->get( $key, $callback = null, $namespace = null );
    }

    public static function delete( $key )
    {
        $cache = Cache::getInstance( static::$driver );
        $cache->delete( $key );
    }

    public static function flushNamespace( $namespace )
    {
        $cache = Cache::getInstance( static::$driver );
        $cache->flushNamespace( $namespace );
    }

    public static function flush()
    {
        $cache = Cache::getInstance( static::$driver );
        $cache->flush();
    }
}