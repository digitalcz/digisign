<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class AccountBilling extends BaseResource
{
    public string $customerId;
    public bool $hasSubscription;
    public ?DateTime $billingPeriodStart;
    public ?DateTime $billingPeriodEnd;
    public int $userUsage;
    public ?int $userLimit;
    public int $envelopeUsage;
    public ?int $envelopeLimit;
    public int $smsUsage;
    public int $bankIdUsage;
}
