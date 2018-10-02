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
        $this->assertThrows(InvalidKeyException::class, function () {
            $decoration = new KeyPatternStorageDecoration('/\d+/');
            $decoration->key('a');
        });
    }
}
