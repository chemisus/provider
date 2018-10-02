<?php

namespace Chemisus\Storage;

use Chemisus\Storage\StorageDecoration\CompositeStorageDecoration;
use Chemisus\Storage\StorageDecoration\KeyPatternStorageDecoration;

class FilteredStorageTest extends StorageTest
{
    public function factory()
    {
        $storage = new FilteredStorage(
            $array = new ArrayStorage(),
            new CompositeStorageDecoration(
                new KeyPatternStorageDecoration('/\w+/')
            )
        );

        $entries = ['a' => 'A', 'b' => 'B', 'c' => 'C'];
        foreach ($entries as $key => $value) {
            $storage->put($key, $value);
        }
        return $storage;
    }

    public function testPatternFailed()
    {
        $storage = new StackStorage(
            $level0 = new ArrayStorage(),
            new FilteredStorage(
                $level1 = new ArrayStorage(),
                new KeyPatternStorageDecoration('/\d+/')
            )
        );

        $key = 'a';
        $value = 'A';

        $storage->put($key, $value);

        $this->assertEquals($value, $level0->get($key));
        $this->assertThrows(InvalidKeyException::class, [$level1, 'get'], $key);
    }
}
