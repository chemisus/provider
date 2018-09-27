<?php

namespace Chemisus\Serialization;

use Exception;

class GZipSerializer implements Serializer
{
    public function serialize($value)
    {
        if (!is_string($value)) {
            throw new Exception();
        }

        return gzdeflate($value);
    }

    public function deserialize($string)
    {
        return gzinflate($string);
    }
}
