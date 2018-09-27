<?php

namespace Chemisus\Provider;

use Chemisus\Storage\ArrayStorage;

class StorageProviderTest extends ProviderTest
{
    public static function factory()
    {
        return new StorageProvider(new ArrayStorage(['a' => 'A', 'b' => 'B', 'c' => 'C']));
    }
}
