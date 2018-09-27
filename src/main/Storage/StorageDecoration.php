<?php

namespace Chemisus\Storage;

interface StorageDecoration
{
    public function key($key);

    public function get($key, $value);

    public function beforePut($key, $value);

    public function afterPut($key, $value);

    public function beforeRemove($key);

    public function afterRemove($key);
}
