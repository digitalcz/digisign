<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

final class BillingProfile extends BaseResource
{
    use EntityResourceTrait;

    public string $productPlanName;
    public string $productPlanType;
    public Features $features;
    public Limits $limits;
    public ?Address $address;
    public ?string $companyName;
    public ?string $identificationNumber;
    public ?string $vatNumber;
    public ?string $billingEmail;
}
