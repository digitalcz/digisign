<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTemplateRecipient extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $alias;

    /** @var string */
    public $role;

    /** @var string */
    public $signatureType;

    /** @var string */
    public $authenticationOnOpen;

    /** @var string */
    public $authenticationOnSignature;

    /** @var string */
    public $authenticationOnDownload;

    /** @var string|null */
    public $name;

    /** @var string|null */
    public $email;

    /** @var string|null */
    public $mobile;

    /** @var string|null */
    public $emailBody;

    /** @var string */
    public $language;

    /** @var string */
    public $channelForSigner;

    /** @var string */
    public $channelForDownload;

    /** @var int */
    public $signingOrder;

    /** @var string */
    public $intermediaryName;

    /** @var string */
    public $intermediaryEmail;
}
