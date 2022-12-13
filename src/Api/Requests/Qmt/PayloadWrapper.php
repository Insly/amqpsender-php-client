<?php

declare(strict_types=1);

namespace Insly\AmqpSenderClient\Api\Requests\Qmt;

use RuntimeException;

class PayloadWrapper
{
    private array $data = [];

    private array $meta = [];

    private string $tenantTag = '';

    private string $requestId = '';

    private ?User $user;

    private string $actionTag = '';

    /**
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return $this
     */
    public function setMeta(array $meta): self
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return $this
     */
    public function setTenantTag(string $tenantTag): self
    {
        $this->tenantTag = $tenantTag;
        return $this;
    }

    /**
     * @return $this
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return $this
     */
    public function setRequestId(string $requestId): self
    {
        $this->requestId = $requestId;
        return $this;
    }

    /**
     * @return $this
     */
    public function setActionTag(string $actionTag): self
    {
        $this->actionTag = $actionTag;
        return $this;
    }

    public function toArray(): array
    {
        if (! $this->user) {
            throw new RuntimeException('No user provided for the queue payload');
        }

        return [
            'request_id' => $this->requestId,
            'data' => $this->data,
            'meta' => $this->meta,
            'tenantTag' => $this->tenantTag,
            'user' => $this->user->toArray(),
            'action_tag' => $this->actionTag,
        ];
    }
}
