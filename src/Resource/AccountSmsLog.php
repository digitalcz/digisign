<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class AccountSmsLog extends BaseResource
{
    public ?string $envelopeId = null;

    public ?string $recipientId = null;

    public string $type;

    public string $mobile;

    public ?DateTime $sendAt = null;

    public ?string $smsId = null;
}
