<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class BatchSendingStats extends BaseResource
{
    public int $total;

    public int $success;

    public int $failed;

    public int $deleted;

    public int $waiting;

    public int $totalEnvelopes;

    public int $sent;

    public int $completed;

    public int $declined;

    public int $expired;

    public int $cancelled;

    public int $correction;

    public int $disapproved;

    public int $totalRecipients;

    public int $deliveryFailed;

    public int $sendSignedDocumentsFailed;

    public int $identificationFailed;
}
