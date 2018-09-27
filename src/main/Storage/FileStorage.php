<?php

namespace Chemisus\Storage;

use Chemisus\Serialization\Serializer;

class FileStorage implements Storage
{
    /**
     * @var string
     */
    private $directory;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @param string $directory
     * @param Serializer $serializer
     */
    public function __construct($directory, Serializer $serializer)
    {
        $this->directory = $directory;
        $this->serializer = $serializer;
    }

    public function path($key)
    {
        return $this->directory . '/' . urlencode($key);
    }

    public function get($key)
    {
        $path = $this->path($key);

        if (!file_exists($path)) {
            throw new InvalidKeyException();
        }

        $value = $this->serializer->deserialize(file_get_contents($path));

        return $value;
    }

    public function put($key, $value)
    {
        file_put_contents($this->path($key), $this->serializer->serialize($value));
    }

    public function remove($key)
    {
        $file = $this->path($key);

        if (file_exists($file)) {
            unlink($file);
            `sync`;
        }
    }
}