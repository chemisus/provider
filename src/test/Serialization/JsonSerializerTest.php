<?php

namespace Chemisus\Serialization;

class JsonSerializerTest extends SerializerTest
{
    public static function factory()
    {
        return new JsonSerializer();
    }

    public  static function serialize($value)
    {
        return json_encode($value);
    }
}
