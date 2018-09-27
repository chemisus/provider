<?php

namespace Chemisus\Storage;

use Chemisus\Serialization\JsonSerializer;

class FileStorageTest extends StorageTest
{
    public static function factory()
    {
        return new FileStorage(__DIR__, new JsonSerializer());
    }

    protected function setUp()
    {
        parent::setUp();

        file_put_contents(__DIR__ . '/a', json_encode('A'));
        file_put_contents(__DIR__ . '/b', json_encode('B'));
        file_put_contents(__DIR__ . '/c', json_encode('C'));
    }

    protected function tearDown()
    {
        parent::tearDown();

        $files = ['a', 'b', 'c', 'm', 'n', 'o'];

        foreach ($files as $file) {
            $file = __DIR__ . '/' . $file;
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}
