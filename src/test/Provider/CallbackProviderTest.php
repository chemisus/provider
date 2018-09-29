<?php

namespace Chemisus\Provider;

use Chemisus\Storage\ArrayStorage;

class CallbackProviderTest extends ProviderTest
{
    public static function factory()
    {
        $provider = new StorageProvider(new ArrayStorage(['a' => 'A', 'b' => 'B', 'c' => 'C']));

        return new CallbackProvider(function ($context) use ($provider) {
            return $provider->provide($context);
        });
    }
}
