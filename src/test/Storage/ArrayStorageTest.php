<?php

namespace Chemisus\Storage;

class ArrayStorageTest extends StorageTest
{
    public function factory()
    {
        return new ArrayStorage(['a' => 'A', 'b' => 'B', 'c' => 'C']);
    }
}
