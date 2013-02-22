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
        $cache->set( $key, $value, $namespace );
    }

    public static function get( $key, $callback = null, $namespace = null )
    {
        $cache = Cache::getInstance( static::$driver );
        return $cache->get( $key, $callback, $namespace );
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