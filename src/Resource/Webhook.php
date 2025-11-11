<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Webhook extends BaseResource
{
    use EntityResourceTrait;

    public string $event;

    public string $url;

    public string $status;

    public string $secret;

    public ?string $oAuthTokenEndpoint;

    public ?string $oAuthClientId;

    public ?string $oAuthClientSecret;

    public ?string $oAuthIntrospectEndpoint;

    public ?DateTime $faultyNotifiedAt;

    /** @var string[] $oAuthScopes */
    public array $oAuthScopes;
}
