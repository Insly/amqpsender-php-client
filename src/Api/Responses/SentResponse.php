<?php

declare(strict_types=1);

namespace Insly\AmqpSenderClient\Api\Responses;

use GuzzleHttp\Utils;
use Psr\Http\Message\ResponseInterface;

class SentResponse implements AMQPResponseInterface
{
    protected ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getBody(): string
    {
        return (string) $this->response->getBody();
    }

    public function getBodyJson(): array
    {
        return (array) Utils::jsonDecode($this->getBody(), true);
    }
}
