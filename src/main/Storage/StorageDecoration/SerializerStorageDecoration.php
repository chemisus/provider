<?php

namespace Chemisus\Storage\StorageDecoration;

use Chemisus\Serialization\Serializer;

class SerializerStorageDecoration extends AbstractStorageDecoration
{
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function get($key, $value)
    {
        return $this->serializer->deserialize($value);
    }

    public function beforePut($key, $value)
    {
        return $this->serializer->serialize($value);
    }
}