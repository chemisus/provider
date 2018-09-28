<?php

namespace Chemisus\Storage;

use Chemisus\TestCase;

abstract class StorageTest extends TestCase
{
    public abstract function factory();

    public function testFactory()
    {
        self::assertInstanceOf(Storage::class, $this->factory());
    }

    public function dataInvalidKey()
    {
        $storage = $this->factory();

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

    public function dataValidKey()
    {
        $storage = $this->factory();

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

    public function dataMutate()
    {
        $storage = $this->factory();

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
