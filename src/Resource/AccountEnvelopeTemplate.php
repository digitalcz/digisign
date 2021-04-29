<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class AccountEnvelopeTemplate extends BaseResource
{
    use EntityResourceTrait;

    public string $signatureType;
    public string $authenticationMethod;
    public string $authenticationPlace;
    public bool $authenticateOnDownload;
    public string $language;
    public string $channelForSigner;
    public string $channelForDownload;
}
