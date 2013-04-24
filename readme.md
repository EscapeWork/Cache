# EscapeWork\Cache (Beta) [![Build Status](https://secure.travis-ci.org/EscapeWork/Cache.png)](http://travis-ci.org/EscapeWork/Cache)

Em construção.

### Exemplos

```php
use EscapeWork\Cache\Facade as Cache;

# setting 
Cache::set('key', 'value', 'namespace'); # namespace é opcional 

# getting
# if the value don't exists in cache, the closure is called
Cache::get('key', function() {
    return 'your function to get data';
}, 'namespace');

# deleting 
Cache::delete('key');

# flush namespace 
Cache::flushNamespace('namespace');

# flush all cache 
Cache::flush();
```

### Tipos de cache disponíveis

- Memcached
- APC
- File
- Array (Para testes unitários)

### Configuração

```php
use EscapeWork\Cache\Facade as Cache;

Cache::driver(array(
    'driver' => 'memcached', 
    'memcached' => array(
        array('host' => 'your-host', 'port' => 11211) # server settings 
    ), 
));

Cache::driver(array(
    'driver' => 'file', 
    'path'   => '/path/to/your/cache/dir/', 
));
```

### Instalação 

A instalação está disponível via [Composer](https://packagist.org/packages/escapework/cache). Autoload compátivel com a PSR-0.

```
{
    "require": {
        "escapework/cache": "0.1.*"
    }
}
```