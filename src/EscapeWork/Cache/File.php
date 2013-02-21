<?php namespace EscapeWork\Cache;

class File implements Cacheable
{

    private static $directory = null;

    public function set( $key, $value = null )
    {
        $value = serialize( $value );
        $key   = $this->buildFileName( $key );

        $this->save( $key, $value );
    }


    public function get( $key )
    {
        $file = static::$directory . $this->buildFileName( $key );

        if( is_file( $file ) )
        {
            return unserialize( file_get_contents( $file ) );
        }

        return false;
    }


    public function delete( $key )
    {
        $file = static::$directory . $this->buildFileName( $key );

        if( is_file( $file ) )
        {
            unlink( $file );
        }
    }


    public function flush()
    {
        $files = new \DirectoryIterator( static::$directory );

        foreach( $files as $file )
        {
            if( !$file->isDir() )
            {
                unlink( static::$directory . $file->getFilename() );
            }
        }
    }


    private function save( $file, $data )
    {
        file_put_contents( static::$directory . $file, $data );
    }

    public static function setDirectory( $directory )
    {
        static::$directory = $directory;
    }

    private function buildFileName( $key )
    {
        return md5( $key ) . '.php';
    }
}