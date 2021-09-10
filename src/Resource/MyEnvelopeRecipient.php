<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class MyEnvelopeRecipient extends BaseResource
{
    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string */
    public $role;

    /** @var string */
    public $status;

    /** @var string */
    public $authenticationOnOpen;

    /** @var string */
    public $authenticationOnSignature;

    /** @var string */
    public $authenticationOnDownload;

    /** @var string */
    public $signatureType;

    /** @var string */
    public $intermediaryName;

    /** @var string */
    public $intermediaryEmail;
}
