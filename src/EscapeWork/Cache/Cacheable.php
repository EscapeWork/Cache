<?php namespace EscapeWork\Cache;

interface Cacheable
{
    public function set();

    public function get();

    public function delete();

    public function flush();
}