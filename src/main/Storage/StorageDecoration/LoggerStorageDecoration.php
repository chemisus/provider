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
        $this->logger->log($this->level, sprintf("GET %s", $key), ['value' => $value]);
        return $value;
    }

    public function beforePut($key, $value)
    {
        $this->logger->log($this->level, sprintf("PUT %s", $key), ['value' => $value]);
        return $value;
    }

    public function beforeRemove($key)
    {
        $this->logger->log($this->level, sprintf("DEL %s", $key));
    }
}
