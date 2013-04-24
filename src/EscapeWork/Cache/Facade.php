<?php namespace EscapeWork\Cache;

class Facade
{

    public static $options = array(
        'driver' => 'file', 
        'path'   => 'cache/'
    );

    private static $cache;

    public static $setValueByClosure = true;

    public static function driver($options)
    {
        static::$options = $options;
        static::$cache   = Cache::getInstance(static::$options);
    }

    public static function __callStatic($method, $parameters)
    {
        return call_user_func_array(array(static::$cache, $method), $parameters);
    }
}