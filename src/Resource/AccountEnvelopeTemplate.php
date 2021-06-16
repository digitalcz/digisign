<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class AccountEnvelopeTemplate extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $signatureType;

    /** @var string */
    public $authenticationMethod;

    /** @var string */
    public $authenticationPlace;

    /** @var bool */
    public $authenticateOnDownload;

    /** @var string */
    public $language;

    /** @var string */
    public $channelForSigner;

    /** @var string */
    public $channelForDownload;

    /** @var bool */
    public $timestampDocuments;

    /** @var bool */
    public $sendCompleted;
}
