<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class AccountRequest extends BaseResource
{
    public string $endpoint;

    public string $ip;

    public string $source;

    public string $method;

    /** @var mixed[] */
    public array $queryParams;

    /** @var mixed[]|null */
    public ?array $requestBody = null;

    public int $status;

    /** @var mixed[]|null */
    public ?array $responseBody = null;

    public string $id;

    public DateTime $createdAt;

    public ?Blame $createdBy = null;

    public DateTime $requestTime;

    public DateTime $responseTime;

    public int $duration;
}
