<?php

namespace Chemisus\Provider;

interface Provider
{
    /**
     * @param $context
     * @return mixed
     * @throws UnresolvableException
     */
    public function provide($context);
}