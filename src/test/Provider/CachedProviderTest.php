<?php

namespace Chemisus\Provider;

use Chemisus\Storage\ArrayStorage;
use Chemisus\Storage\InvalidKeyException;

class CachedProviderTest extends ProviderTest
{
    public static function factory()
    {
        return new CachedProvider(
            new ArrayStorage(['a' => 'A', 'b' => 'B']),
            new StorageProvider(new ArrayStorage(['b' => 'B', 'c' => 'C']))
        );
    }

    public function testProvidePopulatesCache()
    {
        $cache = new ArrayStorage(['a' => 'A', 'b' => 'B']);
        $storage = new StorageProvider(new ArrayStorage(['b' => 'B', 'c' => 'C']));
        $provider = new CachedProvider($cache, $storage);

        $context = 'c';
        $value = 'C';

        $this->assertThrows(InvalidKeyException::class, [$cache, 'get'], $context);
        $provider->provide($context);
        $this->assertEquals($value, $cache->get($context));
    }

    public function testProvideUsesCacheFirst()
    {
        $cache = new ArrayStorage(['a' => 'A', 'b' => 'B']);
        $storage = new StorageProvider(new ArrayStorage(['b' => 'BB', 'c' => 'C']));
        $provider = new CachedProvider($cache, $storage);

        $context = 'b';
        $expect = 'B';
        $actual = $provider->provide($context);

        $this->assertEquals($expect, $actual);
    }
}
