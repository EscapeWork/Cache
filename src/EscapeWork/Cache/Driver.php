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

    public static function get( $options )
    {
        if( isset( static::$availableDrivers[ $options['driver'] ] ) )
        {
            $object = new ReflectionClass( static::$availableDrivers[ $options['driver'] ] );
            return $object->newInstance( $options );
        }
        else
        {
            throw new InvalidArgumentException("Driver " . $options['driver'] . " not found!");
        }
    }
}