<?php

namespace Chemisus\Provider;

use Chemisus\Storage\InvalidKeyException;
use Chemisus\Storage\Storage;

class CachedProvider implements Provider
{
    /**
     * @var Storage
     */
    private $storage;

    /**
     * @var Provider
     */
    private $provider;

    public function __construct(Storage $storage, Provider $provider)
    {
        $this->storage = $storage;
        $this->provider = $provider;
    }

    public function key($context)
    {
        return $context;
    }

    public function provide($context)
    {
        $key = $this->key($context);
        try {
            return $this->storage->get($key);
        } catch (InvalidKeyException $e) {
            $value = $this->provider->provide($context);
            $this->storage->put($key, $value);
            return $value;
        }
    }
}
