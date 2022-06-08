<?php

namespace Insly\AmqpSenderClient\Api;

use Insly\AmqpSenderClient\Api\Endpoints\ExchangeEndpoint;
use Insly\AmqpSenderClient\Config;

class Client
{
    use GuzzleWrapperTrait;

    public const EXCHANGE_EVENTS = 'events';

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $exchangeName
     * @return ExchangeEndpoint
     */
    public function exchange(string $exchangeName): ExchangeEndpoint
    {
        return new ExchangeEndpoint($this, $exchangeName);
    }

    /**
     * Alias for exchange('events')
     *
     * @return ExchangeEndpoint
     */
    public function events(): ExchangeEndpoint
    {
        return $this->exchange(static::EXCHANGE_EVENTS);
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }
}
