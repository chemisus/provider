<?php

namespace Chemisus\Serialization;

class PHPSerializer implements Serializer
{
    /**
     * @var array
     */
    private $deserializeOptions;

    public function __construct(array $deserializeOptions = [])
    {
        $this->deserializeOptions = $deserializeOptions;
    }

    public function serialize($value)
    {
        return serialize($value);
    }

    public function deserialize($string)
    {
        return unserialize($string, $this->deserializeOptions);
    }
}