<?php

namespace Chemisus\Storage;

class ArrayStorage implements Storage
{
    /**
     * @var array
     */
    private $entries;

    public function __construct(array $entries = [])
    {
        $this->entries = $entries;
    }

    public function contains($key)
    {
        return array_key_exists($key, $this->entries);
    }

    public function get($key)
    {
        if (!$this->contains($key)) {
            throw new InvalidKeyException();
        }

        return $this->entries[$key];
    }

    public function put($key, $value)
    {
        $this->entries[$key] = $value;
    }

    public function remove($key)
    {
        unset($this->entries[$key]);
    }
}