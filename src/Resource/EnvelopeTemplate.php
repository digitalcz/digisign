<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTemplate extends BaseResource
{
    use EntityResourceTrait;

    /** @var Collection<EnvelopeTemplateDocument> */
    public $documents;

    /** @var Collection<EnvelopeTemplateRecipient> */
    public $recipients;

    /** @var Collection<EnvelopeTemplateNotification> */
    public $notifications;

    /** @var Collection<EnvelopeTemplateTag> */
    public $tags;

    /** @var string */
    public $emailSubject;

    /** @var string */
    public $emailBody;

    /** @var int */
    public $expiration;

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

    /** @var array<string> */
    public $fileCategoriesToConvert;

    /** @var array<string, string> */
    public $bankIdScopes;

    /** @var bool */
    public $useDefaultTemplateSettings;
}
