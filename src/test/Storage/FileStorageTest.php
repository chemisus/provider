<?php

namespace Chemisus\Storage;

class FileStorageTest extends StorageTest
{
    public static function factory()
    {
        return new FileStorage(__DIR__);
    }

    protected function setUp()
    {
        parent::setUp();

        file_put_contents(__DIR__ . '/a', 'A');
        file_put_contents(__DIR__ . '/b', 'B');
        file_put_contents(__DIR__ . '/c', 'C');
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
