<?php namespace EscapeWork\Cache;

class ArrayDriver implements Cacheable
{

    private static $cache = array();

    public function set( $key, $value = null )
    {
        $value = serialize( $value );
        $key   = $this->buildFileName( $key );

        $this->save( $key, $value );
    }


    public function get( $key )
    {
        $key = $this->buildFileName( $key );

        if( isset( static::$cache[ $key ] ) )
        {
            return unserialize( static::$cache[ $key ] );
        }

        return false;
    }


    public function delete( $key )
    {
        $key = $this->buildFileName( $key );

        if( isset( static::$cache[ $key ] ) )
        {
            unset( static::$cache[ $key ] );
        }
    }


    public function flush()
    {
        static::$cache = array();
    }


    private function save( $key, $value )
    {
        static::$cache[ $key ] = $value;
    }

    private function buildFileName( $key )
    {
        return md5( $key );
    }
}