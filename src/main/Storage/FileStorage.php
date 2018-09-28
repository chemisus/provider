<?php

namespace Chemisus\Storage;

class FileStorage implements Storage
{
    /**
     * @var string
     */
    private $directory;

    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        $this->directory = $directory;
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

        return file_get_contents($path);
    }

    public function put($key, $value)
    {
        file_put_contents($this->path($key), $value);
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