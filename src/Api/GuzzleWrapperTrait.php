<?php

declare(strict_types=1);

namespace Insly\AmqpSenderClient\Api;

use GuzzleHttp\Client as GuzzleClient;
use Insly\AmqpSenderClient\Config;
use Psr\Http\Message\ResponseInterface;

/**
 * @property Config $config
 */
trait GuzzleWrapperTrait
{
    public function post(string $uri, array $jsonData, ?array $headers = null): ResponseInterface
    {
        return $this->createClient()
            ->post(
                $uri,
                $this->getRequestOptions($jsonData, $this->mergeHeaders($headers))
            );
    }

    protected function createClient(): GuzzleClient
    {
        return new GuzzleClient([
            'base_uri' => $this->config->getBaseUrl(),
        ]);
    }

    protected function getRequestOptions(array $jsonData, array $headers): array
    {
        return [
            'json' => $jsonData,
            'headers' => $headers,
        ];
    }

    protected function mergeHeaders(?array $additionalHeaders): array
    {
        $headers = [];

        $authToken = $this->config->getAuthToken();

        if ($authToken) {
            $headers['Authorization'] = $authToken;
        }

        if ($additionalHeaders) {
            $headers += $additionalHeaders;
        }

        return $headers;
    }
}
