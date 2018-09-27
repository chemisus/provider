<?php

namespace Chemisus\Serialization;

class Base64SerializerTest extends SerializerTest
{
    public static function factory()
    {
        return new CompositeSerializer(
            new JsonSerializer(),
            new Base64Serializer()
        );
    }

    public static function serialize($value)
    {
        return base64_encode(json_encode($value));
    }

    public function testSerializeNonString()
    {
        $serializer = new Base64Serializer();
        $this->assertThrows(\Exception::class, [$serializer, 'serialize'], []);
    }
}
