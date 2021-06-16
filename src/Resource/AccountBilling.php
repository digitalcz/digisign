<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class AccountBilling extends BaseResource
{
    /** @var string */
    public $customerId;

    /** @var bool */
    public $hasSubscription;

    /** @var DateTime|null */
    public $billingPeriodStart;

    /** @var DateTime|null */
    public $billingPeriodEnd;

    /** @var int */
    public $userUsage;

    /** @var int|null */
    public $userLimit;

    /** @var int */
    public $envelopeUsage;

    /** @var int|null */
    public $envelopeLimit;

    /** @var int */
    public $smsUsage;

    /** @var int */
    public $bankIdUsage;
}
