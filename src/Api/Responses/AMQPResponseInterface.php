<?php

declare(strict_types=1);

namespace Insly\AmqpSenderClient\Api\Responses;

interface AMQPResponseInterface
{
    public function getStatusCode(): int;

    public function getBody(): string;

    public function getBodyJson(): array;
}
