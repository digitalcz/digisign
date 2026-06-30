<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Features extends BaseResource
{
    public bool $branding;
    public bool $brandingPlus;
    public bool $timestamps;
    public bool $timestampsAtsa;
    public bool $timestampsPostSignum;
    public bool $fileCertificates;
    public bool $identify;
    public bool $identifyBankId;
    public bool $signatureScenarios;
    public bool $smsId;
    public bool $emailSender;
    public bool $identifyAi;
    public bool $batchSending;
    public bool $automaticTagsPlacement;
    public bool $bulkSigning;
    public bool $api;
    public string $bankIdProduct;
    public bool $bankIdSign;
    public bool $bankIdQSign;
}
