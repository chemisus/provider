<?php

namespace Chemisus\Provider;

use Chemisus\TestCase;

abstract class ProviderTest extends TestCase
{
    public abstract static function factory();

    public function testFactory()
    {
        self::assertInstanceOf(Provider::class, static::factory());
    }

    public static function dataProvideThrowsUnresolvedException()
    {
        $provider = static::factory();

        return [
            [$provider, 'x'],
            [$provider, 'y'],
            [$provider, 'z'],
        ];
    }

    /**
     * @dataProvider dataProvideThrowsUnresolvedException
     * @param Provider $provider
     * @param $context
     */
    public function testProvideThrowsUnresolvedException(Provider $provider, $context)
    {
        $this->assertThrows(UnresolvableException::class, [$provider, 'provide'], $context);
    }


    public static function dataProvide()
    {
        $provider = static::factory();

        return [
            [$provider, 'a', 'A'],
            [$provider, 'b', 'B'],
            [$provider, 'c', 'C'],
        ];
    }

    /**
     * @dataProvider dataProvide
     * @param Provider $provider
     * @param mixed $context
     * @param mixed $expect
     */
    public function testProvide(Provider $provider, $context, $expect)
    {
        $actual = $provider->provide($context);
        self::assertEquals($expect, $actual);
    }
}
