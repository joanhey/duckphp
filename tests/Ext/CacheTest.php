<?php 
namespace tests\DuckPhp\Ext;
use DuckPhp\Ext\Cache;
use DuckPhp\Ext\RedisManager;

class CacheTest extends \PHPUnit\Framework\TestCase
{
    public function testAll()
    {
        \MyCodeCoverage::G()->begin(Cache::class);

        $key="ABC";
        $keys=["A","B"];
        $value=['z'=>DATE(DATE_ATOM)];
        $values=['1',"2"];
        $ttl=3600;
        $default="111111";
        Cache::G()->set($key, $value, $ttl );
        $t=Cache::G()->get($key, $default);
        var_dump($t);
        Cache::G()->delete($key);
        Cache::G()->has($key);
        Cache::G()->clear();
        Cache::G()->getMultiple($keys, $default);
        Cache::G()->setMultiple($values, $ttl);
        Cache::G()->deleteMultiple($keys);
        Cache::G()->redis=null;
        Cache::G()->get($key, $default);
        Cache::G()->set($key, $value, $ttl );
        Cache::G()->delete($key);
        Cache::G()->has($key);
        

        \MyCodeCoverage::G()->end();
        /*

        //*/
    }
}
