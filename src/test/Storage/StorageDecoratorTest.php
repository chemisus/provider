<?php

namespace Chemisus\Storage;

use Chemisus\Storage\StorageDecoration\CompositeStorageDecoration;
use Chemisus\Storage\StorageDecoration\TTLStorageDecoration;
use Chemisus\Storage\StorageDecoration\UpperCaseKeyStorageDecoration;

class StorageDecoratorTest extends StorageTest
{
    public function factory()
    {
        $storage = new StorageDecorator(
            $array = new ArrayStorage(),
            new CompositeStorageDecoration(
                new UpperCaseKeyStorageDecoration(),
                new TTLStorageDecoration()
            )
        );

        $entries = ['a' => 'A', 'b' => 'B', 'c' => 'C'];
        foreach ($entries as $key => $value) {
            $storage->put($key, $value);
        }
        return $storage;
    }
}
