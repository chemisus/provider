<?php

namespace Chemisus\Storage;

class ArrayStorageTest extends StorageTest
{
    public static function factory()
    {
        return new ArrayStorage(['a' => 'A', 'b' => 'B', 'c' => 'C']);
    }
}
