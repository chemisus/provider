<?php

namespace Chemisus\Serialization;

class CompositeSerializer implements Serializer
{
    /**
     * @var Serializer[]
     */
    private $serializers;

    public function __construct(Serializer ...$serializers)
    {
        $this->serializers = $serializers;
    }

    public function serialize($value)
    {
        foreach ($this->serializers as $serializer) {
            $value = $serializer->serialize($value);
        }

        return $value;
    }

    public function deserialize($string)
    {
        /**
         * @var Serializer $serializer
         */
        foreach (array_reverse($this->serializers) as $serializer) {
            $string = $serializer->deserialize($string);
        }

        return $string;
    }
}