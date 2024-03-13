<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class SentEnvelopeReport extends BaseResource
{
    public string $id;

    public string $emailSubject;

    /** @var string[] */
    public array $labels;

    public string $createdBy;

    public DateTime $createdAt;

    public DateTime $sentAt;

    public string $status;

    /** @var string[] */
    public array $recipients;

    public int $documentsCount;

    public int $smsCount;

    public int $bankIdConnectCount;

    public int $bankIdIdentifyCount;

    public int $bankIdIdentifyPlusCount;

    public int $bankIdSignCount;

    public int $identifyAmlCount;

    public string $sender;
}
