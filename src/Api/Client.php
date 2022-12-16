<?php

declare(strict_types=1);

namespace Insly\AmqpSenderClient\Api;

use Insly\AmqpSenderClient\Api\Endpoints\ExchangeEndpoint;
use Insly\AmqpSenderClient\Config;

class Client
{
    use GuzzleWrapperTrait;

    public const EXCHANGE_EVENTS = 'events';

    protected Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function exchange(string $exchangeName): ExchangeEndpoint
    {
        return new ExchangeEndpoint($this, $exchangeName);
    }

    /**
     * Alias for exchange('events')
     */
    public function events(): ExchangeEndpoint
    {
        return $this->exchange(static::EXCHANGE_EVENTS);
    }

    public function getConfig(): Config
    {
        return $this->config;
    }
}
