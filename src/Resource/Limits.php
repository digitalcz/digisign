<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Limits extends BaseResource
{
    public ?int $envelopesMonthly;

    public ?int $users;

    public ?int $userContacts;

    public ?int $accountContacts;

    public ?int $documents;

    public ?int $noneOrManualMonthlyIdentifications;

    public ?int $aiMonthlyIdentifications;

    public ?int $tags;

    public ?int $fileSize;
}
