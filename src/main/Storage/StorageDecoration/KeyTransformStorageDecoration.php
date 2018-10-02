<?php

namespace Chemisus\Storage\StorageDecoration;

class KeyTransformStorageDecoration extends AbstractStorageDecoration
{
    /**
     * @var
     */
    private $transformations;

    public function __construct($transformations)
    {
        $this->transformations = $transformations;
    }

    public function key($key)
    {
        return strtr($key, $this->transformations);
    }
}