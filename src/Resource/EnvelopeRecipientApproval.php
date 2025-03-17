<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

final class EnvelopeRecipientApproval extends BaseResource
{
    use EntityResourceTrait;

    public string $result;

    public DateTime $time;

    public ?string $message;

    public ?string $confirmation;
}
