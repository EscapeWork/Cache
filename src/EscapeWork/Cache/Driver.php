<?php namespace EscapeWork\Cache;

use \InvalidArgumentException;

class Driver
{
    
    /**
     * Available drivers 
     */
    private static $availableDrivers = array(
        'memcached' => '\Memcached', 
        'memcache'  => '\Memcache', 
        'redis'     => '', 
        'apc'       => 'EscapeWork\Cache\Apc', 
        'file'      => 'EscapeWork\Cache\File', 
        'array'     => 'Array', 
    );


    public static function get( $driver )
    {
        if( isset( static::$availableDrivers[ $driver ] ) )
        {
            return new static::$availableDrivers[ $driver ];
        }
        else
        {
            throw new InvalidArgumentException("Driver " . $driver . " not found!");
        }
    }
}