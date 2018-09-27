<?php

namespace Chemisus\Provider;

class FirstProvider implements Provider
{
    /**
     * @var Provider[]
     */
    private $providers;

    public function __construct(Provider ...$providers)
    {
        $this->providers = $providers;
    }

    public function provide($context)
    {
        foreach ($this->providers as $provider) {
            try {
                return $provider->provide($context);
            } catch (UnresolvableException $e) {
            }
        }

        throw new UnresolvableException();
    }
}