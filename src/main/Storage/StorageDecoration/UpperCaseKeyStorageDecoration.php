<?php

namespace Chemisus\Storage\StorageDecoration;

class UpperCaseKeyStorageDecoration extends AbstractStorageDecoration
{
    public function key($key)
    {
        return strtoupper($key);
    }
}