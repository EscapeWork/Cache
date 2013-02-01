<?php namespace EscapeWork\Cache;

class Cache
{

    /**
     * Objeto pra dizer se o cache está ativo
     */ 
    private static $active = false;


    /**
     * Objeto do cache 
     */ 
    private static $object;


    /**
     * Tempo de cache 
     */ 
    private static $time = 36000; # 10 horas 


    /**
     * Driver do cache
     */
    private static $driver = 'file';


    /**
     * Namespace do contexto atual 
     */ 
    public static 
        $namespace    = null, 
        $namespaceKey = null;


    /**
     * Setando como ativo ou não 
     * 
     * @access public 
     * @param  boolean $active 
     * @return void 
     */ 
    public static function setActive( $active )
    {
        self::$active = $active;
    }


    /**
     * Setando o namespace do contexto atual
     * 
     * @access public 
     * @param  string $namespace 
     * @return void 
     */ 
    public static function setNamespace( $namespace )
    {
        self::$namespace = $namespace;

        self::$namespaceKey = self::getNamespaceKey( $namespace );
    }


    /**
     * Limpando o namespace 
     * 
     * @access public 
     * @return void 
     */ 
    public static function clearNamespace()
    {
        self::$namespace = null;
    }


    /**
     * Verificando se o cache está ativo 
     * 
     * @static 
     * @access public 
     * @return boolean 
     */ 
    public function isActive()
    {
        return self::$active;
    }


    /**
     * Setando o objeto 
     * 
     * @access public 
     * @param object $object 
     * @return void 
     */ 
    public static function setObject( $object )
    {
        self::$object = $object;
    }


    /**
     * Setando uma configuração do cache 
     * O Terceiro parametros é o namespace do cache, por exemplo noticias
     * Se não for passado, será utilizado o que está como padrão, que pode ser null, ou o que foi setado no tempo de execução 
     * 
     * @access public 
     * @param string $key 
     * @param string $value 
     * @param string $namespaceKey 
     * @return mixed 
     */ 
    public static function set( $key, $value, $namespace = null )
    {
        if( self::isActive() )
        {
            if( is_null( $namespace ) )
            {
                $namespaceKey = self::$namespaceKey;
            }
            else
            {
                $namespaceKey = self::getNamespaceKey( $namespace );
            }

            self::$object->set( $namespaceKey . $key, $value, false, self::$time );
        }
    }


    /**
     * Retornando uma configuração do cache 
     * 
     * @access public 
     * @param  string $key 
     * @param  string $namespaceKey 
     * @return mixed 
     */ 
    public static function get( $key, $callback = null, $namespace = null )
    {
        if( self::isActive() )
        {
            if( is_null( $namespace ) )
            {
                $namespaceKey = self::$namespaceKey;
            }
            else
            {
                $namespaceKey = self::getNamespaceKey( $namespace );
            }

            return self::$object->get( $namespaceKey . $key );
        }

        return false;
    }


    /**
     * Deletando um registro do cache 
     * 
     * @access public 
     * @param  string $key 
     * @return mixed 
     */ 
    public static function delete( $key )
    {
        if( self::isActive() )
        {
            return self::$object->delete( self::$namespaceKey . $key );
        }

        return false;
    }


    /**
     * Fazendo o flush de todos os registros no cache 
     * 
     * @access public 
     * @param  string $key 
     * @return mixed 
     */ 
    public static function flush()
    {
        if( self::isActive() )
        {
            return self::$object->flush();
        }

        return false;
    }


    /**
     * Incrementando um namespace
     * 
     * @static 
     * @access public 
     * @return void 
     */ 
    public static function flushNamespace( $namespace )
    {
        if( self::isActive() )
        {
            self::$object->set('namespace.' . $namespace, microtime());
        }
    }


    /**
     * Retornando o key do namespace, se existir
     * Caso não exista, é criada uma nova key 
     * 
     * @static 
     * @access public 
     * @return void 
     */ 
    public static function getNamespaceKey( $namespace )
    {
        if( !$namespaceKey = self::get('namespace.' . $namespace) )
        {
            $namespaceKey = microtime();

            self::set('namespace.' . $namespace, $namespaceKey);
        }

        return $namespaceKey;
    }


    /**
     * Setando o tempo de cache 
     * 
     * @static 
     * @access public 
     * @param  int    $time 
     * @return void 
     */ 
    public static function setTime( int $time )
    {
        self::$time = $time;
    }
}