<?php

namespace Chemisus\Storage;

use Chemisus\TestCase;

abstract class StorageTest extends TestCase
{
    public abstract static function factory();

    public function testFactory()
    {
        self::assertInstanceOf(Storage::class, static::factory());
    }

    public static function dataInvalidKey()
    {
        $storage = static::factory();

        return [
            'x' => [$storage, 'x'],
            'y' => [$storage, 'y'],
            'z' => [$storage, 'z']
        ];
    }

    /**
     * @dataProvider dataInvalidKey
     * @param Storage $storage
     * @param string $key
     */
    public function testGetThrowsInvalidKey(Storage $storage, $key)
    {
        $this->assertThrows(InvalidKeyException::class, [$storage, 'get'], $key);
    }

    public static function dataValidKey()
    {
        $storage = static::factory();

        return [
            'a' => [$storage, 'a', 'A'],
            'b' => [$storage, 'b', 'B'],
            'c' => [$storage, 'c', 'C']
        ];
    }

    /**
     * @dataProvider dataValidKey
     * @param Storage $storage
     * @param string $key
     * @param mixed $expect
     */
    public function testGet(Storage $storage, $key, $expect)
    {
        $actual = $storage->get($key);
        $this->assertEquals($expect, $actual);
    }

    public static function dataMutate()
    {
        $storage = static::factory();

        return [
            'm' => [$storage, 'm', 'M'],
            'n' => [$storage, 'n', 'N'],
            'o' => [$storage, 'o', 'O']
        ];
    }

    /**
     * @dataProvider dataMutate
     * @param Storage $storage
     * @param string $key
     * @param mixed $value
     * @depends      testGetThrowsInvalidKey
     * @depends      testGet
     */
    public function testPut(Storage $storage, $key, $value)
    {
        $this->testGetThrowsInvalidKey($storage, $key);
        $storage->put($key, $value);
        $this->testGet($storage, $key, $value);
    }

    /**
     * @dataProvider dataMutate
     * @param Storage $storage
     * @param string $key
     * @param mixed $value
     * @depends      testPut
     */
    public function testRemove(Storage $storage, $key, $value)
    {
        $this->testPut($storage, $key, $value);
        $storage->remove($key);
        $this->testGetThrowsInvalidKey($storage, $key);
    }
}
