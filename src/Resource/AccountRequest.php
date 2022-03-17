<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class AccountRequest extends BaseResource
{
    /** @var string */
    public $endpoint;

    /** @var string */
    public $ip;

    /** @var string */
    public $source;

    /** @var string */
    public $method;

    /** @var mixed[] */
    public $queryParams;

    /** @var mixed[]|null */
    public $requestBody;

    /** @var int */
    public $status;

    /** @var mixed[]|null */
    public $responseBody;

    /** @var string */
    public $id;

    /** @var DateTime */
    public $createdAt;

    /** @var string|null */
    public $createdBy;

    /** @var DateTime */
    public $requestTime;

    /** @var DateTime */
    public $responseTime;

    /** @var int */
    public $duration;
}
