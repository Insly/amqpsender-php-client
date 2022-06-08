<?php

namespace Insly\AmqpSenderClient\Api\Requests\Qmt;

class User
{
    public const CUSTOM_ATTR_DOMAIN = 'custom:domain';
    public const CUSTOM_ATTR_DOMAIN_META = 'custom:domain_meta';

    public const DOMAIN_TENANT = 'tenant';
    public const DOMAIN_NETWORK = 'network';
    public const DOMAIN_AGENCY = 'agency';
    public const DOMAIN_BRANCH = 'branch';
    public const DOMAIN_DEPARTMENT = 'department';
    public const DOMAIN_TEAM = 'team';

    public const DOMAIN_META_BROKER_NAME = 'broker_name';
    public const DOMAIN_META_BRANCH = 'branch';
    public const DOMAIN_META_TEAM = 'team';
    public const DOMAIN_META_DEPARTMENT = 'department';

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var string
     */
    private $id = '';

    /**
     * @param array $attributes
     * @return $this
     */
    public function addAttributes(array $attributes): self
    {
        $this->attributes += $attributes;
        return $this;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param array $domain
     * @return $this
     */
    public function setDomain(array $domain): self
    {
        return $this->addAttributes(
            [
                self::CUSTOM_ATTR_DOMAIN => \GuzzleHttp\json_encode($domain)
            ]
        );
    }

    /**
     * @param array $meta
     * @return $this
     */
    public function setDomainMeta(array $meta): self
    {
        return $this->addAttributes(
            [
                self::CUSTOM_ATTR_DOMAIN_META => \GuzzleHttp\json_encode($meta)
            ]
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'attributes' => $this->attributes,
            'id' => $this->id
        ];
    }
}
