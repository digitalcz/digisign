<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class AccountSmsLog extends BaseResource
{
    public string $envelopeId;
    public string $recipientId;
    public string $mobile;
    public ?DateTime $sendAt;
    public ?string $smsId;
}
