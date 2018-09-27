<?php

namespace Chemisus\Provider;

use Chemisus\Storage\ArrayStorage;

class FirstProviderTest extends ProviderTest
{
    public static function factory()
    {
        return new FirstProvider(
            new StorageProvider(new ArrayStorage(['a' => 'A', 'b' => 'B'])),
            new StorageProvider(new ArrayStorage(['b' => 'BB', 'c' => 'C']))
        );
    }

    public function testProvideUsesFirstProvider()
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
