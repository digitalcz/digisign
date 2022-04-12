<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class AccountSmsLog extends BaseResource
{
    /** @var string|null */
    public $envelopeId;

    /** @var string|null */
    public $recipientId;

    /** @var string */
    public $type;

    /** @var string */
    public $mobile;

    /** @var DateTime|null */
    public $sendAt;

    /** @var string|null */
    public $smsId;
}
