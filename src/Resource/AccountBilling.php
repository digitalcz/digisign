<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class AccountBilling extends BaseResource
{
    public string $customerId;

    public bool $hasSubscription;

    public string $planName;

    public ?DateTime $billingPeriodStart;

    public ?DateTime $billingPeriodEnd;

    public int $userUsage;

    public ?int $userLimit;

    public int $envelopeUsage;

    public ?int $envelopeLimit;

    public int $smsUsage;

    public int $bankIdConnectUsage;

    public int $bankIdIdentifyUsage;

    public int $bankIdIdentifyPlusUsage;

    public bool $branding;

    public bool $brandingPlus;

    public bool $timestamps;

    public bool $fileCertificates;

    public bool $identify;

    public bool $signatureScenarios;

    public bool $identifyAi;
}
