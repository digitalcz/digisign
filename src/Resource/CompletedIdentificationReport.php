<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class CompletedIdentificationReport extends BaseResource
{
    public string $id;
    public ?string $envelopeId;
    public ?string $envelopeRecipientId;
    public string $status;
    public string $approvalMode;
    public DateTime $createdAt;
    public ?DateTime $completedAt;
    public ?DateTime $forReviewAt;
    public ?DateTime $approvedAt;
    public ?DateTime $deniedAt;
}
