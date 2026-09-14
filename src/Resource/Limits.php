<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Limits extends BaseResource
{
    public ?int $users = null;

    public ?int $userContacts = null;

    public ?int $accountContacts = null;

    public ?int $accounts = null;

    public ?int $envelopes = null;

    public ?int $documents = null;

    public ?int $recipients = null;

    public ?int $templates = null;

    public ?int $noneOrManualIdentifications = null;

    public ?int $aiIdentifications = null;

    public ?int $tags = null;

    public ?int $fileSize = null;

    public ?int $archiveRetentionDays = null;

    public ?int $requestLogRetentionDays = null;

    /** One of `monthly`|`yearly` */
    public string $frequency;

    /** @deprecated Use $envelopes instead */
    public ?int $envelopeMonthly = null;

    /** @deprecated Use $noneOrManualIdentifications instead */
    public ?int $noneOrManualMonthlyIdentifications = null;

    /** @deprecated Use $aiIdentifications instead */
    public ?int $aiMonthlyIdentifications = null;
}
