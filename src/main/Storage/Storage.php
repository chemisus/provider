<?php

namespace Chemisus\Storage;

interface Storage
{
    /**
     * @param string $key
     * @return mixed
     * @throws InvalidKeyException
     */
    public function get($key);

    /**
     * @param string $key
     * @param mixed $value
     */
    public function put($key, $value);

    /**
     * @param string $key
     */
    public function remove($key);
}