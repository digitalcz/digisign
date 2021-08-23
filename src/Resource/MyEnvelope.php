<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class MyEnvelope extends BaseResource
{
    /** @var string */
    public $id;

    /** @var string */
    public $status;

    /** @var string */
    public $emailSubject;

    /** @var string */
    public $emailBody;

    /** @var string|null */
    public $senderName;

    /** @var string|null */
    public $senderEmail;

    /** @var DateTime|null */
    public $sentAt;

    /** @var Collection<MyEnvelopeDocument> */
    public $documents;

    /** @var Collection<MyEnvelopeRecipient> */
    public $recipients;
}
