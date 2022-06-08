<?php

namespace Insly\AmqpSenderClient\Api\Responses;

use Psr\Http\Message\ResponseInterface;

class SentResponse implements AMQPResponseInterface
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return (string)$this->response->getBody();
    }

    /**
     * @return array
     */
    public function getBodyJson(): array
    {
        return (array)\GuzzleHttp\json_decode($this->getBody(), true);
    }
}
