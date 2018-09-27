<?php

namespace Chemisus;

use Throwable;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function assertThrows($expect, $callback, ...$params)
    {
        $actual = null;
        try {
            call_user_func_array($callback, $params);
        } catch (Throwable $error) {
            $actual = $error;
        } finally {
            $this->assertInstanceOf($expect, $actual);
        }
    }
}