<?php

namespace Chemisus\Storage\StorageDecoration;

use Chemisus\Storage\StorageDecoration;

class CompositeStorageDecoration implements StorageDecoration
{
    /**
     * @var StorageDecoration[]
     */
    private $decorations;

    public function __construct(StorageDecoration ... $decorations)
    {
        $this->decorations = $decorations;
    }

    public function key($key)
    {
        foreach ($this->decorations as $decoration) {
            $key = $decoration->key($key);
        }

        return $key;
    }

    public function get($key, $value)
    {
        /**
         * @var StorageDecoration $decoration
         */
        foreach (array_reverse($this->decorations) as $decoration) {
            $value = $decoration->get($key, $value);
        }

        return $value;
    }

    public function beforePut($key, $value)
    {
        foreach ($this->decorations as $decoration) {
            $value = $decoration->beforePut($key, $value);
        }
        return $value;
    }

    public function afterPut($key, $value)
    {
        foreach ($this->decorations as $decoration) {
            $decoration->afterPut($key, $value);
        }
    }

    public function beforeRemove($key)
    {
        foreach ($this->decorations as $decoration) {
            $decoration->beforeRemove($key);
        }
    }

    public function afterRemove($key)
    {
        /**
         * @var StorageDecoration $decoration
         */
        foreach (array_reverse($this->decorations) as $decoration) {
            $decoration->afterRemove($key);
        }
    }
}