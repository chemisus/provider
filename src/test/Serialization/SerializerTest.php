<?php

namespace Chemisus\Serialization;

use Chemisus\TestCase;

abstract class SerializerTest extends TestCase
{
    public abstract static function factory();
    public abstract static function serialize($value);

    public function testFactory()
    {
        self::assertInstanceOf(Serializer::class, static::factory());
    }

    public static function dataProvider()
    {
        $serializer = static::factory();

        return array_map(function ($value) use ($serializer) {
            return [$serializer, $value, static::serialize($value)];
        }, [
            null,
            'null',
            0,
            1,
            -1,
            0.5,
            -0.6,
            true,
            false,
            [1, 2, 3],
            (object)['a' => 'A', 'b' => 5],
        ]);
    }

    /**
     * @dataProvider dataProvider
     * @param Serializer $serializer
     * @param mixed $value
     * @param string $expect
     */
    public function testSerialize(Serializer $serializer, $value, $expect)
    {
        $actual = $serializer->serialize($value);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider dataProvider
     * @param Serializer $serializer
     * @param mixed $expect
     * @param string $string
     */
    public function testDeserialize(Serializer $serializer, $expect, $string)
    {
        $actual = $serializer->deserialize($string);
        $this->assertEquals($expect, $actual);
    }
}
