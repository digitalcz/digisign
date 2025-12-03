<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

final class SignInfo extends BaseResource
{
    public string $signatureType;
    public ?DateTime $signedAt;

    /** @var array<BankIdRequestInfo>  */
    public array $bankIdRequests;
}
