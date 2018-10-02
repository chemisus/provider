<?php

namespace Chemisus\Storage\StorageDecoration;

use Chemisus\Storage\InvalidKeyException;

class KeyPatternStorageDecoration extends AbstractStorageDecoration
{
    /**
     * @var string
     */
    private $pattern;

    public function __construct($pattern)
    {
        $this->pattern = $pattern;
    }

    public function beforePut($key, $value)
    {
        if (!preg_match($this->pattern, $key)) {
            throw new InvalidKeyException();
        }
    }
}
