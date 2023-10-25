<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class AccountSettings extends BaseResource
{
    use EntityResourceTrait;

    public ?string $fullName = null;

    public ?string $shortName = null;

    public ?string $defaultSenderName = null;

    public ?string $defaultSenderEmail = null;

    public ?string $debuggingEmail = null;

    public ?string $identificationNumber = null;

    public ?string $vatNumber = null;

    public ?Image $logo = null;

    public ?Address $address = null;

    public string $bankIdProduct;

    public bool $bankIdSign;

    public string $defaultMobileCountryCode;

    public string $defaultLanguage;

    public bool $useEnvelopeDescription;

    public bool $signatureScenarios;

    public bool $documentsMerging;

    public bool $identify;

    public bool $notificationForSenderEmail;
}
