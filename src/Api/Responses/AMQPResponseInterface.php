<?php

namespace Insly\AmqpSenderClient\Api\Responses;

interface AMQPResponseInterface
{
    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @return string
     */
    public function getBody(): string;

    /**
     * @return array
     */
    public function getBodyJson(): array;
}
