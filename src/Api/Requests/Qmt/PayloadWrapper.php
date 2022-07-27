<?php

namespace Insly\AmqpSenderClient\Api\Requests\Qmt;

use RuntimeException;

class PayloadWrapper
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var array
     */
    private $meta = [];

    /**
     * @var string
     */
    private $tenantTag = '';

    /**
     * @var string
     */
    private $requestId = '';

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $actionTag = '';

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param array $meta
     * @return $this
     */
    public function setMeta(array $meta): self
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @param string $tenantTag
     * @return $this
     */
    public function setTenantTag(string $tenantTag): self
    {
        $this->tenantTag = $tenantTag;
        return $this;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @param string $requestId
     * @return $this
     */
    public function setRequestId(string $requestId): self
    {
        $this->requestId = $requestId;
        return $this;
    }

    /**
     * @param string $actionTag
     * @return $this
     */
    public function setActionTag(string $actionTag): self
    {
        $this->actionTag = $actionTag;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        if (!$this->user) {
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
