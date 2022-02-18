<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class SentEnvelopeReport extends BaseResource
{
    /** @var string */
    public $id;

    /** @var string */
    public $emailSubject;

    /** @var string[] */
    public $labels;

    /** @var string */
    public $createdBy;

    /** @var DateTime */
    public $createdAt;

    /** @var DateTime */
    public $sentAt;

    /** @var string */
    public $status;

    /** @var string[] */
    public $recipients;

    /** @var int */
    public $documentsCount;

    /** @var int */
    public $smsCount;

    /** @var int */
    public $bankIdConnectCount;

    /** @var int */
    public $bankIdIdentifyCount;

    /** @var int */
    public $bankIdIdentifyPlusCount;
}
