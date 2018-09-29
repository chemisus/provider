<?php

namespace Chemisus\Provider;

class CallbackProviderTest extends ProviderTest
{
    public static function factory()
    {
        $entries = ['a' => 'A', 'b' => 'B', 'c' => 'C'];

        return new CallbackProvider(function ($key) use ($entries) {
            return $entries[$key];
        });
    }
}
