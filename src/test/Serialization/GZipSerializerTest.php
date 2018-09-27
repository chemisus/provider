<?php

namespace Chemisus\Serialization;

use Exception;

class GZipSerializerTest extends SerializerTest
{
    public static function factory()
    {
        return new CompositeSerializer(
            new JsonSerializer(),
            new GZipSerializer(),
            new Base64Serializer()
        );
    }

    public static function serialize($value)
    {
        return base64_encode(gzdeflate(json_encode($value)));
    }

    public function testSerializeNonString()
    {
        $serializer = new GZipSerializer();
        $this->assertThrows(Exception::class, [$serializer, 'serialize'], []);
    }
}
