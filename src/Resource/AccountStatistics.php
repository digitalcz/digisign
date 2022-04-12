<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class AccountStatistics extends BaseResource
{
    /** @var int */
    public $countEnvelopeDraft;

    /** @var int */
    public $countEnvelopeSent;

    /** @var int */
    public $countEnvelopeCompleted;

    /** @var int */
    public $countEnvelopeCanceled;

    /** @var int */
    public $countEnvelopeDeclined;

    /** @var int */
    public $countAuthorizationRequestSMS;

    /** @var int */
    public $countDeliveriesSent;

    /** @var int */
    public $countBankIdConnect;

    /** @var int */
    public $countBankIdIdentify;

    /** @var int */
    public $countBankIdIdentifyPlus;

    /** @var int */
    public $countActiveUsers;
}
