<?php

namespace Chemisus\Storage;

class StackStorageTest extends StorageTest
{
    public function factory()
    {
        return new StackStorage(
            new ArrayStorage(['a' => 'A', 'b' => 'B']),
            new ArrayStorage(['b' => 'BB', 'c' => 'C'])
        );
    }

    public function testGetStoresUpward()
    {
        $key = 'a';
        $value = 'A';
        $a = new ArrayStorage();
        $b = new ArrayStorage([$key => $value]);
        $stack = new StackStorage($a, $b);
        $this->assertThrows(InvalidKeyException::class, [$a, 'get'], $key);
        $this->assertEquals($value, $stack->get($key));
        $this->assertEquals($value, $a->get($key));
    }

    public function testPutStoresDownward()
    {
        $key = 'a';
        $value = 'A';
        $a = new ArrayStorage();
        $b = new ArrayStorage();
        $stack = new StackStorage($a, $b);
        $this->assertThrows(InvalidKeyException::class, [$a, 'get'], $key);
        $this->assertThrows(InvalidKeyException::class, [$b, 'get'], $key);
        $stack->put($key, $value);
        $this->assertEquals($value, $a->get($key));
        $this->assertEquals($value, $b->get($key));
    }

    public function testRemoveDeletesDownward()
    {
        $key = 'a';
        $value = 'A';
        $a = new ArrayStorage([$key => $value]);
        $b = new ArrayStorage([$key => $value]);
        $stack = new StackStorage($a, $b);
        $this->assertEquals($value, $a->get($key));
        $this->assertEquals($value, $b->get($key));
        $stack->remove($key);
        $this->assertThrows(InvalidKeyException::class, [$a, 'get'], $key);
        $this->assertThrows(InvalidKeyException::class, [$b, 'get'], $key);
    }
}
