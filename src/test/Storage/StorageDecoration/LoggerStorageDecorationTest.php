<?php

namespace Chemisus\Storage\StorageDecoration;

use Chemisus\Storage\ArrayStorage;
use Chemisus\Storage\Storage;
use Chemisus\TestCase;
use Psr\Log\LoggerInterface;

class LoggerStorageDecorationTest extends TestCase
{
    private $key = 'a';
    private $value = 'A';

    public function testStorage()
    {
        $this->assertTrue(true);
        return new ArrayStorage([$this->key => $this->value]);
    }

    /**
     * @param Storage $storage
     * @depends testStorage
     * @return Storage
     */
    public function testGet(Storage $storage)
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('log')
            ->with('info', 'GET ' . $this->key);

        $decorator = new LoggerStorageDecoration($logger);
        $actual = $decorator->get($this->key, $this->value);
        $this->assertEquals($this->value, $actual);
        return $storage;
    }

    /**
     * @param Storage $storage
     * @depends testStorage
     * @return Storage
     */
    public function testPut(Storage $storage)
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('log')
            ->with('info', 'PUT ' . $this->key);

        $decorator = new LoggerStorageDecoration($logger);
        $actual = $decorator->beforePut($this->key, $this->value);
        $this->assertEquals($this->value, $actual);
        return $storage;
    }

    /**
     * @param Storage $storage
     * @depends testStorage
     * @return Storage
     */
    public function testRemove(Storage $storage)
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('log')
            ->with('info', 'DEL ' . $this->key);

        $decorator = new LoggerStorageDecoration($logger);
        $decorator->beforeRemove($this->key);
        return $storage;
    }
}
