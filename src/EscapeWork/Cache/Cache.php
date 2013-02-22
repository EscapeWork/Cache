<?php namespace EscapeWork\Cache;

class Cache
{

    /**
     * Singleton
     */
    private static $instance;

    /**
     * Objeto do cache 
     */ 
    private static $object;


    /**
     * Tempo de cache 
     */ 
    private $time = 36000; # 10 horas 


    /**
     * Driver do cache
     */
    private $driver = null;


    /**
     * Namespace do contexto atual 
     */ 
    public 
        $namespace    = null, 
        $namespaceKey = null;


    /**
     * Retornando a instância
     */
    public static function getInstance($driver)
    {
        if( is_null( static::$instance ) )
        {
            return static::$instance = new Cache($driver);
        }

        return static::$instance;
    }


    /**
     * Construtor
     * @param string $driver com o tipo de driver desejado
     */
    private function __construct($driver)
    {
        static::setObject( Driver::get( $driver ) );
    }


    /**
     * Setando o namespace do contexto atual
     * 
     * @access public 
     * @param  string $namespace 
     * @return void 
     */ 
    public function setNamespace( $namespace )
    {
        $this->namespace    = $namespace;
        $this->namespaceKey = $this->getNamespaceKey( $namespace );
    }


    /**
     * Limpando o namespace 
     * 
     * @access public 
     * @return void 
     */ 
    public function clearNamespace()
    {
        $this->namespace    = null;
        $this->namespaceKey = null;
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
        static::$object = $object;
    }


    /**
     * Retornando o objeto 
     */
    public function getObject()
    {
        return static::$object;
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
    public function set( $key, $value, $namespace = null )
    {
        $namespaceKey = $this->getNamespaceKey( $namespace );

        $this->getObject()->set( $namespaceKey . $key, $value );
    }


    /**
     * Retornando uma configuração do cache 
     * 
     * @access public 
     * @param  string $key 
     * @param  string $namespaceKey 
     * @return mixed 
     */ 
    public function get( $key, $callback = null, $namespace = null )
    {
        $namespaceKey = $this->getNamespaceKey( $namespace );

        $value = $this->getObject()->get( $namespaceKey . $key );

        if( $value === false )
        {
            $value = $this->execute( $callback );
        }

        return $value;
    }


    /**
     * Executando uma função de callback
     *
     * @access  private
     * @param   closure $callback
     * @return  mixed
     */
    private function execute( $callback )
    {
        if( is_callable( $callback ) )
        {
            return call_user_func_array( $callback );
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
    public function delete( $key )
    {
        return $this->getObject()->delete( $this->namespaceKey . $key );
    }


    /**
     * Fazendo o flush de todos os registros no cache 
     * 
     * @access public 
     * @param  string $key 
     * @return mixed 
     */ 
    public function flush()
    {
        return $this->getObject()->flush();
    }


    /**
     * Incrementando um namespace
     *  
     * @access public 
     * @return void 
     */ 
    public function flushNamespace( $namespace = null )
    {
        if( is_null( $namespace ) )
        {
            $namespace = $this->namespace;
        }

        $this->getObject()->set('namespace.' . $namespace, time());
    }


    /**
     * Retornando o key do namespace, se existir
     * Caso não exista, é criada uma nova key 
     *  
     * @access public 
     * @return void 
     */ 
    public function getNamespaceKey( $namespace )
    {
        if( is_null( $namespace ) )
        {
            return $this->namespaceKey;
        }

        if( !$namespaceKey = $this->get('namespace.' . $namespace) )
        {
            $namespaceKey = time();

            $this->set('namespace.' . $namespace, $namespaceKey);
        }

        return $namespaceKey;
    }


    /**
     * Setando o tempo de cache 
     * 
     * @access public 
     * @param  int    $time 
     * @return void 
     */ 
    public function setTime( int $time )
    {
        $this->time = $time;
    }
}