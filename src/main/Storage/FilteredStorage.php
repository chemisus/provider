<?php

namespace Chemisus\Storage;

class FilteredStorage extends StorageDecorator
{
    public function put($key, $value)
    {
        try {
            parent::put($key, $value);
        } catch (StorageException $error) {
        }
    }
}
