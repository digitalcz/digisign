<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Branding extends BaseResource
{
    use EntityResourceTrait;

    public string $name;

    public ?string $defaultSenderName = null;

    public ?string $defaultSenderEmail = null;

    public ?Image $logo = null;

    public string $logoSize;

    public ?string $primaryColor = null;

    public ?string $complementaryColor = null;

    public ?string $secondaryColor = null;

    /** @var array<string, string> */
    public ?array $ownConditions;

    /** @var array<string, string> */
    public ?array $signerReturnUrl;

    public ?AccountSmsSender $smsSender;

    public ?AccountEmailSender $emailSender;

    public string $tagBrandingUsageType;

    /** @var array<string, string> */
    public ?array $ownSmsText;

    public bool $ownSmsIncludeDomain = true;
}
