<?php namespace EscapeWork\Cache;

interface Cacheable
{
    public function set( $key, $value = null );

    public function get( $key, $callback = null );

    public function delete( $key );

    public function flush();
}