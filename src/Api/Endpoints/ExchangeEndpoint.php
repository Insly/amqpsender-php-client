<?php

declare(strict_types=1);

namespace Insly\AmqpSenderClient\Api\Endpoints;

use Insly\AmqpSenderClient\Api\Client;
use Insly\AmqpSenderClient\Api\Responses\SentResponse;

class ExchangeEndpoint
{
    private Client $client;

    private string $exchangeName;

    public function __construct(Client $client, string $exchangeName)
    {
        $this->client = $client;
        $this->exchangeName = $exchangeName;
    }

    public function trigger(string $routingKey, array $data): SentResponse
    {
        return new SentResponse(
            $this->client->post(
                $this->getEndpointPath($routingKey),
                $data
            )
        );
    }

    private function getEndpointPath(string $routingKey): string
    {
        return sprintf(
            '/api/v1/amqpsender/e/%s/key/%s',
            $this->exchangeName,
            $this->prefixTenant($routingKey)
        );
    }

    private function prefixTenant(string $routingKey): string
    {
        // Tenant already provided
        if (strpos($routingKey, 't:') === 0) {
            return $routingKey;
        }

        // No point going further
        if (! $this->client->getConfig()->getTenant()) {
            return $routingKey;
        }

        return sprintf(
            't:%s:%s',
            $this->client->getConfig()->getTenant(),
            $routingKey
        );
    }
}
