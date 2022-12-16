<?php

declare(strict_types=1);

namespace Insly\AmqpSenderClient\Api\Requests\Qmt;

use GuzzleHttp\Utils;

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

    private array $attributes = [];

    private string $id = '';

    /**
     * @return $this
     */
    public function addAttributes(array $attributes): self
    {
        $this->attributes += $attributes;
        return $this;
    }

    /**
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return $this
     */
    public function setDomain(array $domain): self
    {
        return $this->addAttributes(
            [
                self::CUSTOM_ATTR_DOMAIN => Utils::jsonEncode($domain),
            ]
        );
    }

    /**
     * @return $this
     */
    public function setDomainMeta(array $meta): self
    {
        return $this->addAttributes(
            [
                self::CUSTOM_ATTR_DOMAIN_META => Utils::jsonEncode($meta),
            ]
        );
    }

    public function toArray(): array
    {
        return [
            'attributes' => $this->attributes,
            'id' => $this->id,
        ];
    }
}
