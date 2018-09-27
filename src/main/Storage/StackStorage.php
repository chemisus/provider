<?php

namespace Chemisus\Storage;

class StackStorage implements Storage
{
    /**
     * @var Storage[]
     */
    private $levels;

    public function __construct(Storage ...$levels)
    {
        $this->levels = $levels;
    }

    public function get($key)
    {
        /**
         * @var Storage[] $levels
         */
        $levels = [];

        foreach ($this->levels as $level) {
            try {
                $value = $level->get($key);

                foreach ($levels as $storage) {
                    $storage->put($key, $value);
                }

                return $value;
            } catch (InvalidKeyException $e) {
                $levels[] = $level;
            }
        }

        throw new InvalidKeyException();
    }

    public function put($key, $value)
    {
        foreach ($this->levels as $storage) {
            $storage->put($key, $value);
        }
    }

    public function remove($key)
    {
        foreach ($this->levels as $storage) {
            $storage->remove($key);
        }
    }
}