<?php namespace EscapeWork\Cache;

class Facade
{

    public static $options = array(
        'cache.driver' => 'file', 
        'cache.path'   => 'cache/'
    );

    private static $cache;

    public static $setValueByClosure = true;

    public static function driver( array $options )
    {
        static::$options = $options;
        static::$cache   = Cache::getInstance( static::$options );
    }

    public static function set( $key, $value, $namespace = null )
    {
        static::$cache->set( $key, $value, $namespace );
    }

    public static function get( $key, $callback = null, $namespace = null )
    {
        return static::$cache->get( $key, $callback, $namespace );
    }

    public static function delete( $key )
    {
        static::$cache->delete( $key );
    }

    public static function flushNamespace( $namespace )
    {
        static::$cache->flushNamespace( $namespace );
    }

    public static function flush()
    {
        static::$cache->flush();
    }
}