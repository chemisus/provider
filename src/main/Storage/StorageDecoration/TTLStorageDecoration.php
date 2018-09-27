<?php

namespace Chemisus\Storage\StorageDecoration;

class TTLStorageDecoration extends AbstractStorageDecoration
{
    public const EXPIRATION_KEY = 'expiration';
    public const DATA_KEY = 'data';

    /**
     * @var int
     */
    private $ttl;

    /**
     * @var null
     */
    private $now;

    public function __construct($ttl = 3600, $now = null)
    {
        $this->ttl = $ttl;
        $this->now = $now;
    }

    public function now()
    {
        return $this->now ?? time();
    }

    public function get($key, $value)
    {
        list(self::EXPIRATION_KEY => $expiration, self::DATA_KEY => $data) = $value;

        if ($expiration <= $this->now()) {
            throw new KeyExpiredException();
        }

        return $data;
    }

    public function beforePut($key, $value)
    {
        return [
            self::EXPIRATION_KEY => $this->now() + $this->ttl,
            self::DATA_KEY => $value,
        ];
    }
}