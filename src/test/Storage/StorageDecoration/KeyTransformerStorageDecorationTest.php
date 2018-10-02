<?php

namespace Chemisus\Storage\StorageDecoration;

use Chemisus\Storage\ArrayStorage;
use Chemisus\Storage\StorageDecorator;
use Chemisus\TestCase;

class KeyTransformerStorageDecorationTest extends TestCase
{
    public function test()
    {
        $nsKey = '{ns}';
        $nsValue = 'TEST::';

        $storage = new StorageDecorator(
            $array = new ArrayStorage(),
            new KeyTransformStorageDecoration([
                $nsKey => $nsValue,
            ])
        );

        $key = 'a';
        $value = 'A';

        $key1 = $nsKey . $key;
        $key2 = $nsValue . $key;

        $storage->put($key1, $value);
        $this->assertEquals($value, $storage->get($key1));
        $this->assertEquals($value, $storage->get($key2));
    }
}
