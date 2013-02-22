<?php namespace EscapeWork\Cache;

use \InvalidArgumentException;

class Driver
{
    
    /**
     * Available drivers 
     */
    private static $availableDrivers = array(
        'file'      => 'EscapeWork\Cache\FileDriver', 
        'array'     => 'EscapeWork\Cache\FileDriver', 
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