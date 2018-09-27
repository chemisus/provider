<?php

namespace Chemisus\Serialization;

class PHPSerializerTest extends SerializerTest
{
    public static function factory()
    {
        return new PHPSerializer();
    }

    public static function serialize($value)
    {
        return serialize($value);
    }
}
