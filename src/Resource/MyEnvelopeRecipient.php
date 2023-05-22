<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class MyEnvelopeRecipient extends BaseResource
{
    public string $id;
    public string $name;
    public string $email;
    public string $role;
    public string $status;
    public string $authenticationOnOpen;
    public string $authenticationOnSignature;
    public string $authenticationOnDownload;
    public string $signatureType;
    public ?string $intermediaryName;
    public ?string $intermediaryEmail;
}
