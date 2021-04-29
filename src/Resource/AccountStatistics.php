<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class AccountStatistics extends BaseResource
{
    public int $countEnvelopeDraft;
    public int $countEnvelopeSent;
    public int $countEnvelopeCompleted;
    public int $countEnvelopeCanceled;
    public int $countEnvelopeDeclined;
    public int $countAuthorizationRequestSMS;
}
