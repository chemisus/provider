<?php

namespace Chemisus\Storage\StorageDecoration;

use Chemisus\Serialization\JsonSerializer;
use Chemisus\Storage\ArrayStorage;
use Chemisus\Storage\Storage;
use Chemisus\Storage\StorageDecorator;
use Chemisus\TestCase;

class SerializerStorageDecorationTest extends TestCase
{
    private $key = 'a';
    private $value = 'A';
    private $ttl = 3600;
    private $put = 1000;
    private $getValid = 4000;
    private $getStale = 5600;

    public function testStorage()
    {
        $this->assertTrue(true);
        return new ArrayStorage();
    }

    /**
     * @param Storage $storage
     * @depends testStorage
     * @return Storage
     */
    public function testPut(Storage $storage)
    {
        $decorator = new StorageDecorator($storage, new SerializerStorageDecoration(new JsonSerializer()));
        $decorator->put($this->key, $this->value);
        $this->assertEquals(json_encode($this->value), $storage->get($this->key));
        return $storage;
    }

    /**
     * @param Storage $storage
     * @depends testPut
     * @return Storage
     */
    public function testGet(Storage $storage)
    {
        $decorator = new StorageDecorator($storage, new SerializerStorageDecoration(new JsonSerializer()));
        $this->assertEquals($this->value, $decorator->get($this->key));
        return $storage;
    }
}
