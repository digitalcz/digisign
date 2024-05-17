<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class EnvelopeProperties extends BaseResource
{
    public bool $mergeDocuments;

    public ?string $mergedDocumentName = null;

    public bool $declineAllowed;

    public bool $declineReasonRequired;

    /** @var array<string> */
    public array $signatureTagParts;

    public string $labelPositioning;

    public bool $sendDocumentsAsEmailAttachment;

    public bool $generateSignatureSheet;

    public bool $auditLogAvailableToAllRecipients;

    public bool $auditLogAvailableToAccountUsers;

    public bool $timestampDocuments;

    public bool $timestampAuditLog;

    /** @var array<string> */
    public array $timestampingAuthorities;

    public bool $sendCompleted;

    public string $channelForSender;
}
