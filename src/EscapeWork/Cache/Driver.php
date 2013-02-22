<?php namespace EscapeWork\Cache;

use \InvalidArgumentException;
use \ReflectionClass;

class Driver
{
    
    /**
     * Available drivers 
     */
    private static $availableDrivers = array(
        'memcached' => 'EscapeWork\Cache\MemcachedDriver', 
        'file'      => 'EscapeWork\Cache\FileDriver', 
        'array'     => 'EscapeWork\Cache\ArrayDriver', 
        'apc'       => 'EscapeWork\Cache\ApcDriver', 
    );

    public static function get( array $options )
    {
        if( isset( static::$availableDrivers[ $options['cache.driver'] ] ) )
        {
            $object = new ReflectionClass( static::$availableDrivers[ $options['cache.driver'] ] );
            return $object->newInstance( $options );
        }
        else
        {
            throw new InvalidArgumentException("Driver " . $options['cache.driver'] . " not found!");
        }
    }
}