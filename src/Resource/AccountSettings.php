<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class AccountSettings extends BaseResource
{
    use EntityResourceTrait;

    /** @var string|null */
    public $fullName;

    /** @var string|null */
    public $shortName;

    /** @var string|null */
    public $defaultSenderName;

    /** @var string|null */
    public $defaultSenderEmail;

    /** @var string|null */
    public $debuggingEmail;

    /** @var string|null */
    public $identificationNumber;

    /** @var string|null */
    public $vatNumber;

    /** @var Image|null */
    public $logo;

    /** @var Address|null */
    public $address;

    /** @var string */
    public $bankIdProduct;

    /** @var bool */
    public $bankIdSign;
    
    /** @var string */
    public $defaultMobileCountryCode;
    
    /** @var string */
    public $defaultLanguage;
}
