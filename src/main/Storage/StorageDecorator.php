<?php

namespace Chemisus\Storage;

class StorageDecorator implements Storage
{
    /**
     * @var Storage
     */
    private $storage;

    /**
     * @var StorageDecoration
     */
    private $decoration;

    public function __construct(Storage $storage, StorageDecoration $decoration)
    {
        $this->storage = $storage;
        $this->decoration = $decoration;
    }

    public function get($key)
    {
        $key = $this->decoration->key($key);
        $value = $this->storage->get($key);
        $value = $this->decoration->get($key, $value);
        return $value;
    }

    public function put($key, $value)
    {
        $key = $this->decoration->key($key);
        $value = $this->decoration->beforePut($key, $value);
        $value = $this->storage->put($key, $value);
        $this->decoration->afterPut($key, $value);
    }

    public function remove($key)
    {
        $key = $this->decoration->key($key);
        $this->decoration->beforeRemove($key);
        $this->storage->remove($key);
        $this->decoration->afterRemove($key);
    }
}