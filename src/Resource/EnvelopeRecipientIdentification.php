<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class EnvelopeRecipientIdentification extends BaseResource
{
    public DateTime $createdAt;

    public string $product;

    /** @var mixed[]|null */
    public ?array $bank = null;

    public string $place;

    public bool $authenticated;

    public ?string $error = null;

    public ?VerifiedClaims $claims = null;
}
