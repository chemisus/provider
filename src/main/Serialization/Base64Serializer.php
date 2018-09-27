<?php

namespace Chemisus\Serialization;

use Exception;

class Base64Serializer implements Serializer
{
    public function serialize($value)
    {
        if (!is_string($value)) {
            throw new Exception();
        }

        return base64_encode($value);
    }

    public function deserialize($string)
    {
        return base64_decode($string);
    }
}
