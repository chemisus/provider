<?php

namespace Chemisus\Storage\StorageDecoration;

use Chemisus\Storage\StorageDecoration;

class AbstractStorageDecoration implements StorageDecoration
{
    public function key($key)
    {
        return $key;
    }

    public function get($key, $value)
    {
        return $value;
    }

    public function beforePut($key, $value)
    {
        return $value;
    }

    public function afterPut($key, $value)
    {
        return $value;
    }

    public function beforeRemove($key)
    {
    }

    public function afterRemove($key)
    {
    }
}