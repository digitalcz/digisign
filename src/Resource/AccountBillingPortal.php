<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class AccountBillingPortal extends BaseResource
{
    public string $customerId;
    public string $planName;
    public string $productType;
    public ?string $subscriptionStatus;
    public DateTime $billingPeriodStart;
    public DateTime $billingPeriodEnd;
    public ?DateTime $cancelAt;
    public ?int $userLimit;
    public ?int $userContactLimit;
    public int $accountContactLimit;
    public ?int $envelopeLimit;
    public ?int $identifyAiLimit;
    public ?int $identifyNoneOrManualLimit;
    public int $fileSizeLimit;
    public int $accountLimit;
    public int $userUsage;
    public int $accountContactUsage;
    public int $envelopeUsage;
    public int $smsUsage;
    public int $bankIdConnectUsage;
    public int $bankIdIdentifyUsage;
    public int $bankIdIdentifyPlusUsage;
    public int $bankIdIdentifyAmlUsage;
    public int $identifyAiUsage;
    public int $identifyNoneOrManualUsage;
    public int $activeAccountUsage;
    public string $companyName;
    public ?string $identificationNumber;
    public ?string $vatNumber;
    public ?Price $currentPrice;
}
