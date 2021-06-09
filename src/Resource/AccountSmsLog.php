<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class AccountSmsLog extends BaseResource
{
    /** @var string */
    public $envelopeId;

    /** @var string */
    public $recipientId;

    /** @var string */
    public $mobile;

    /** @var DateTime|null */
    public $sendAt;

    /** @var string|null */
    public $smsId;
}
