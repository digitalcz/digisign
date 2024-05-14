<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

final class CertificateInfo extends BaseResource
{
    public string $subjectCommonName;

    public string $issuerCommonName;

    public DateTime $certificateIssuedAt;

    public DateTime $certificateExpiresAt;

    public ?string $subjectCountry;

    public ?string $subjectOrganizationName;

    public ?string $subjectOrganizationalUnitName;

    public ?string $subjectOtherName;

    public ?string $subjectLocality;

    public ?string $subjectState;

    public ?string $subjectTitle;

    public ?string $subjectGivenName;

    public ?string $subjectInitials;

    public ?string $subjectSurname;

    public ?string $subjectDomainComponent;

    public ?string $subjectEmail;

    public ?string $subjectStreetAddress;

    public ?string $issuerCountry;

    public ?string $issuerOtherName;

    public ?string $issuerOrganizationName;

    public ?string $certificateSerialNumber;

    public ?string $certificateVersion;
}
