# EscapeWork\Cache (Beta)

Em construção.

### Exemplos

```php
use EscapeWork\Cache\Cache;

Cache::set('key', 'value', 'namespace'); # namespace é opcional 
Cache::get('key', function() {
    return 'your function to get data';
}, 'namespace');

# flush namespace 
Cache::flushNamespace('namespace');
```

### Tipos de cache disponíveis

- Memcached
- Redis
- APC
- File

```php
use EscapeWork\Cache\Cache;

Cache::setDriver('memcached');
```

### Instalação 

A instalação está disponível via [Composer](https://packagist.org/packages/escapework/cache). Autoload compátivel com a PSR-0.