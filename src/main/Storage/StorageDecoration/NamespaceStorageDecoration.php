<?php

namespace Chemisus\Storage\StorageDecoration;

class NamespaceStorageDecoration extends AbstractStorageDecoration
{
    /**
     * @var
     */
    private $prefix;

    /**
     * @var
     */
    private $suffix;

    public function __construct($prefix, $suffix = null)
    {
        $this->prefix = $prefix;
        $this->suffix = $suffix;
    }

    public function key($key)
    {
        return $this->prefix . $key . $this->suffix;
    }
}