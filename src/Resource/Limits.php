<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Limits extends BaseResource
{
    public ?int $envelopes;

    /** @deprecated Use $envelopes instead */
    public ?int $envelopesMonthly;

    public ?int $users;

    public ?int $userContacts;

    public ?int $accountContacts;

    public ?int $documents;

    public ?int $noneOrManualIdentifications;

    /** @deprecated Use $noneOrManualIdentifications instead */
    public ?int $noneOrManualMonthlyIdentifications;

    public ?int $aiIdentifications;

    /** @deprecated Use $aiIdentifications instead */
    public ?int $aiMonthlyIdentifications;

    public ?int $tags;

    public ?int $fileSize;

    public string $frequency;
}
