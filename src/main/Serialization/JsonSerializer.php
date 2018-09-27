<?php

namespace Chemisus\Serialization;

class JsonSerializer implements Serializer
{
    /**
     * @var int
     */
    private $serializeOptions;

    /**
     * @var int
     */
    private $deserializeOptions;

    /**
     * @var int
     */
    private $serializeDepth;

    /**
     * @var int
     */
    private $deserializeDepth;

    /**
     * @var bool
     */
    private $deserializeAssoc;

    public function __construct($serializeOptions = 0, $deserializeOptions = 0, $serializeDepth = 512, $deserializeDepth = 512, $deserializeAssoc = false)
    {
        $this->serializeOptions = $serializeOptions;
        $this->deserializeOptions = $deserializeOptions;
        $this->serializeDepth = $serializeDepth;
        $this->deserializeDepth = $deserializeDepth;
        $this->deserializeAssoc = $deserializeAssoc;
    }

    public function serialize($value)
    {
        return json_encode($value, $this->serializeOptions, $this->serializeDepth);
    }

    public function deserialize($string)
    {
        return json_decode($string, $this->deserializeAssoc, $this->deserializeDepth, $this->deserializeOptions);
    }
}