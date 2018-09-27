<?php

namespace Chemisus\Provider;

use Chemisus\Storage\InvalidKeyException;
use Chemisus\Storage\Storage;

class StorageProvider implements Provider
{
    /**
     * @var Storage
     */
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function key($context)
    {
        return $context;
    }

    public function provide($context)
    {
        try {
            return $this->storage->get($this->key($context));
        } catch (InvalidKeyException $e) {
            throw new UnresolvableException();
        }
    }
}