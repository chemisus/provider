<?php

namespace Chemisus\Storage\StorageDecoration;

use Psr\Log\LoggerInterface;

class LoggerStorageDecoration extends AbstractStorageDecoration
{
    /**
     * @var string
     */
    private $level;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger, $level = 'info')
    {
        $this->level = $level;
        $this->logger = $logger;
    }

    public function get($key, $value)
    {
        $this->logger->log($this->level, sprintf("FETCH: %s", $key), ['value' => $value]);
        return $value;
    }
}
