<?php

namespace Insly\AmqpSenderClient\Api;

use GuzzleHttp\Client as GuzzleClient;
use Insly\AmqpSenderClient\Config;
use Psr\Http\Message\ResponseInterface;

/**
 * @property Config $config
 */
trait GuzzleWrapperTrait
{
    /**
     * @param string $uri
     * @param array $jsonData
     * @param array|null $headers
     * @return ResponseInterface
     */
    public function post(string $uri, array $jsonData, ?array $headers = null): ResponseInterface
    {
        return $this->createClient()
            ->post(
                $uri,
                $this->getRequestOptions($jsonData, $this->mergeHeaders($headers))
            );
    }

    /**
     * @return GuzzleClient
     */
    protected function createClient(): GuzzleClient
    {
        return new GuzzleClient([
            'base_uri' => $this->config->getBaseUrl()
        ]);
    }

    /**
     * @param array $jsonData
     * @param array $headers
     *
     * @return array
     */
    protected function getRequestOptions(array $jsonData, array $headers): array
    {
        return [
            'json' => $jsonData,
            'headers' => $headers
        ];
    }

    /**
     * @param array|null $additionalHeaders
     * @return array
     */
    protected function mergeHeaders(?array $additionalHeaders): array
    {
        $headers = [];

        if ($authToken = $this->config->getAuthToken()) {
            $headers['Authorization'] = $authToken;
        }

        if ($additionalHeaders) {
            $headers += $additionalHeaders;
        }

        return $headers;
    }
}
