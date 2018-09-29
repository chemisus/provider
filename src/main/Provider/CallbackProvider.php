<?php

namespace Chemisus\Provider;

class CallbackProvider implements Provider
{
    /**
     * @var callable
     */
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function provide($context)
    {
        return call_user_func($this->callback, $context);
    }
}