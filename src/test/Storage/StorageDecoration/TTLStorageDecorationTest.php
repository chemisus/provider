<?php

namespace Chemisus\Storage\StorageDecoration;

use Chemisus\Storage\ArrayStorage;
use Chemisus\Storage\Storage;
use Chemisus\Storage\StorageDecorator;
use Chemisus\TestCase;

class TTLStorageDecorationTest extends TestCase
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
        $decorator = new StorageDecorator($storage, new TTLStorageDecoration($this->ttl, $this->put));
        $decorator->put($this->key, $this->value);
        $this->assertArrayHasKey(TTLStorageDecoration::EXPIRATION_KEY, $storage->get($this->key));
        $this->assertArrayHasKey(TTLStorageDecoration::DATA_KEY, $storage->get($this->key));
        return $storage;
    }

    /**
     * @param Storage $storage
     * @depends testPut
     * @return Storage
     */
    public function testGet(Storage $storage)
    {
        $decorator = new StorageDecorator($storage, new TTLStorageDecoration($this->ttl, $this->getValid));
        $this->assertEquals($this->value, $decorator->get($this->key));
        return $storage;
    }

    /**
     * @param Storage $storage
     * @depends testGet
     */
    public function testGetStale(Storage $storage)
    {
        $decorator = new StorageDecorator($storage, new TTLStorageDecoration($this->ttl, $this->getStale));
        self::assertThrows(KeyExpiredException::class, [$decorator, 'get'], $this->key);
    }
}
