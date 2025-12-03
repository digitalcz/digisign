<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

final class BankIdRequestInfo extends BaseResource
{
    public DateTime $createdAt;
    public ?DateTime $authorizedAt;
    public string $product;
    public Bank $bank;
    public ?string $error;

    /** @var array<string>  */
    public array $debug;
    public ?string $traceId;

    /** @var array<string> */
    public array $bankIdScopes;
}
